<?php

use App\Championship;
use App\Invite;
use App\Tournament;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class InviteTest extends BrowserKitTest
{
    /**
     * Tests inside:
     * an_admin_may_invite_users_but_users_must_register_after
     * a_user_may_register_an_open_tournament -  FAILING WHEN USING FB
     */

    use DatabaseMigrations;

    protected $root;

    public function setUp()
    {
        parent::setUp();
        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $this->logWithUser($this->root);
    }

    /** @test */
    public function an_admin_invite_users_and_users_register()
    {
        Artisan::call('db:seed', ['--class' => 'TournamentLevelSeeder', '--database' => 'sqlite']);
        Artisan::call('db:seed', ['--class' => 'CountriesSeeder', '--database' => 'sqlite']);
        Artisan::call('db:seed', ['--class' => 'CategorySeeder', '--database' => 'sqlite']);

        // FakeUs3
        $fakeUser1 = factory(User::class)->make(['role_id' => Config::get('constants.ROLE_USER')]);

        // Create a closed tournament with championships
        $tournament = factory(Tournament::class)->create(['type' => Config::get('constants.INVITATION_TOURNAMENT')]);
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
            ->type('["' . $fakeUser1->email . '"]', 'recipients')// Must simulate js plugin
            ->press(trans('core.send_invites'))
            ->seePageIs('/tournaments/' . $tournament->slug . '/edit')
            ->seeInDatabase('invitation',
                ['email' => $fakeUser1->email,
                    'object_id' => $tournament->id,
                    'expiration' => $tournament->registerDateLimit,
                    'active' => 1,
                    'used' => 0,
                ]);

        // Get Full invitation Object
        $invitation = Invite::where('object_id', $tournament->id)
            ->where('object_type', 'App\Tournament')
            ->where('email', $fakeUser1->email)
            ->first();

        // Get Full user object
        $user = User::where('email', $fakeUser1->email)->first();

        //Bad Code or no code
        $this->visit("/tournaments/" . $invitation->object->slug . "/invite/123456s")
            ->see("403");

        // Invitation expired
        if ($invitation->expiration < Carbon::now() && $invitation->expiration != '0000-00-00') {
            $this->see("403");
        }

        if ($invitation->active == 0) {
            $this->see("403");
        }

        // Logout root, and begin user registration
        Auth::logout();

        $this->visit("/tournaments/" . $invitation->object->slug . "/invite/" . $invitation->code);

        // If user didn't exit, check that it is created
        if (is_null($user)) {

            // System redirect to user creation
            $this->type($fakeUser1->name, 'name')
                ->type('222222', 'password')
                ->type('222222', 'password_confirmation')
                ->press(trans('auth.create_account'))
                ->seeInDatabase('users', ['email' => $fakeUser1->email, 'verified' => '1'])
                ->see(trans('auth.registration_completed'));

        } // Unconfirmed User
        elseif ($user->verified == 0) {
            $user->verified = 1;
            $user->save();
        }

        // Get all categories for this tournament
        // Now we are on category Selection page
        foreach ($championships as $championship) {
            $this->type($championship->id, 'cat[' . $championship->id . ']');
        }
        $this->type("aaaaaa", 'firstname')
            ->type("bbbbbb", 'lastname')
            ->press(trans("core.save"));

        foreach ($championships as $key => $championship) {
            $this->seeInDatabase('competitor',
                ['championship_id' => $championship->id,
                    'user_id' => Auth::user()->id,
                ]);
        }
        $this->seePageIs('/users/' . Auth::user()->slug . '/tournaments');

    }

    /** @test */
    public function a_user_may_register_an_open_tournament_with_existing_account()
    {
        Artisan::call('db:seed', ['--class' => 'TournamentLevelSeeder', '--database' => 'sqlite']);
        Artisan::call('db:seed', ['--class' => 'CountriesSeeder', '--database' => 'sqlite']);
        Artisan::call('db:seed', ['--class' => 'CategorySeeder', '--database' => 'sqlite']);

        Auth::logout();
        // Create an open tournament
        $tournament = factory(Tournament::class)->create(['type' => Config::get('constants.OPEN_TOURNAMENT')]);
        $championships = new Collection;

        for ($i = 0; $i < 3; $i++) {
            try {
                $ct = factory(Championship::class)->create(['tournament_id' => $tournament->id]);
                $championships->push($ct);
            } catch (Exception $e) {
            }
        }

        $user = factory(User::class)->create([
            'role_id' => Config::get('constants.ROLE_USER'),
            'password' => bcrypt('111111')
        ]);

        $this->visit("/tournaments/" . $tournament->slug . "/register");

        // System redirect to user creation

        $this->type($user->email, 'email')
            ->type('111111', 'password')
            ->press(trans('auth.signin'));

        $this->visit("/tournaments/" . $tournament->slug . "/register");

        // Get all categories for this tournament
        // Now we are on category Selection page
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
        $this->seePageIs('/users/' . Auth::user()->slug . '/tournaments');
    }
}
