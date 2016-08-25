<?php

use App\Championship;
use App\Invite;
use App\Tournament;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class InviteTest extends TestCase
{
    /**
     * Tests inside:
     * an_admin_may_invite_users_but_users_must_register_after
     * a_user_may_register_an_open_tournament -  FAILING WHEN USING FB 
     */

    use DatabaseTransactions;

    protected $root;

    public function setUp()
    {
        parent::setUp();
        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $this->logWithUser($this->root);
    }

    /** @test */
    public function an_admin_may_invite_users_but_users_must_register_after()
    {
        // Create a closed tournament with championships
        $tournament = factory(Tournament::class)->create(['type' => 0]);
        $championships = new Collection;
        for ($i = 0; $i < 1; $i++) {
            try {
                $championship = factory(Championship::class)->create(['tournament_id' => $tournament->id]);
                $championships->push($championship);
            } catch (Exception $e) {
            }
        }

        // Invite a user
        $this->visit('/tournaments/' . $tournament->slug . '/invite/')
            ->type('["john@example.com","john2@example.com"]', 'recipients')// Must simulate js plugin
            ->press(trans('core.send_invites'))
            ->seePageIs('/tournaments/' . $tournament->slug . '/edit')
            ->seeInDatabase('invitation',
                ['email' => 'john@example.com',
                    'object_id' => $tournament->id,
                    'expiration' => $tournament->registerDateLimit,
                    'active' => 1,
                    'used' => 0,
                ])
            ->seeInDatabase('invitation',
                ['email' => 'john2@example.com',
                    'object_id' => $tournament->id,
                    'expiration' => $tournament->registerDateLimit,
                    'active' => 1,
                    'used' => 0,
                ]);

        // Get Full invitation Object
        $invitation = Invite::where('object_id', $tournament->id)
            ->where('object_type', 'App\Tournament')
            ->where('email', 'john@example.com')
            ->first();

        // Get Full user object
        $user = User::where('email', 'john@example.com')->first();

        //Bad Code or no code
        $this->visit("/tournaments/" . $invitation->object->slug . "/invite/123456s")
            ->see("403");

        // Invitation expired
        if ($invitation->expiration < Carbon::now() && $invitation->expiration != '0000-00-00'){
            $this->see("403");
        }

        if ($invitation->active == 0){
            $this->see("403");
        }


        $this->visit("/tournaments/" . $invitation->object->slug. "/invite/" . $invitation->code);
        // If user didn't exit, check that it is created
        if (is_null($user)) {
            // System redirect to user creation
            $this->type('Johnny', 'name')
                ->type('222222', 'password')
                ->type('222222', 'password_confirmation')
                ->press(Lang::get('auth.create_account'))
                ->seeInDatabase('users', ['email' => 'john@example.com', 'verified' => '1'])
                ->see(trans('auth.registration_completed'));

        } // Unconfirmed User
        elseif ($user->verified == 0){

        }

        // Get all categories for this tournament
        // Now we are on category Selection page
        foreach ($championships as $key => $ct) {
            $this->type($ct->id, 'cat[' . $ct->id . ']');
        }

        $this->press(trans("core.save"));

        foreach ($championships as $key => $ct) {
            $this->seeInDatabase('competitor',
                ['championship_id' => $ct->id,
                    'user_id' => Auth::user()->id,
                ]);
        }
        $this->seePageIs('/invites');

    }

    /** @test */
    public function a_user_may_register_an_open_tournament()
    {
        Auth::logout();
        // Given
        $tournament = factory(Tournament::class)->create(['type' => 1]);
        $championships = new Collection;

        for ($i = 0; $i < 5; $i++) {
            try {
                $ct = factory(Championship::class)->create(['tournament_id' => $tournament->id]);
                $championships->push($ct);
            } catch (Exception $e) {
            }
        }

        $user = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER'),
            'password' => bcrypt('111111') // 111111
        ]);

        $this->visit("/tournaments/" . $tournament->slug . "/register");

        // System redirect to user creation

        $this->type($user->email, 'email')
            ->type('111111', 'password')
            ->press(Lang::get('auth.signin'))
            ->seePageIs('/tournaments/' . $tournament->slug . '/register');
//
//        // Get all categories for this tournament
//        // Now we are on category Selection page
        foreach ($championships as $ct) {
            $this->type($ct->id, 'cat[' . $ct->id . ']');
//
        }
        $this->press(trans("core.save"));
//
        foreach ($championships as $key => $ct) {
            $this->seeInDatabase('competitor',
                ['championship_id' => $ct->id,
                    'user_id' => $user->id,
                ]);
        }
        $this->seePageIs('/invites');
    }
}
