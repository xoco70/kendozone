<?php

use App\CategoryTournament;
use App\Invite;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class InviteTest extends TestCase
{
    /**
     * Tests inside:
     * an_admin_may_invite_users_but_users_must_register_after
     * a_user_may_register_an_open_tournament
     * 1. Send mails and success
     * 3. Click mail, register and add to tournament
     * 4. Click mail and deny - used invitation
     * 5. Click mail and deny - invitation disabled
     *
     */

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        Auth::loginUsingId(1);
    }

    /** @test */
    public function an_admin_may_invite_users_but_users_must_register_after()
    {
        $numCategories = 5;
        // Given
        $tournament = factory(Tournament::class)->create();
        $categoriesTournament = factory(CategoryTournament::class, 5)->create(['tournament_id' => $tournament->id]);

        // Check that inviting one user by email
        $this->visit('/tournaments/' . $tournament->id . '/invite/')
            ->type('["john@example.com","john2@example.com"]', 'recipients')// Must simulate js plugin
            ->press(trans('crud.send_invites'))
            ->seePageIs('/tournaments/' . $tournament->id . '/edit')
            ->seeInDatabase('invitation',
                ['email' => 'john@example.com',
                    'tournament_id' => $tournament->id,
                    'expiration' => $tournament->registerDateLimit,
                    'active' => 1,
                    'used' => 0,
                ])
            ->seeInDatabase('invitation',
                ['email' => 'john2@example.com',
                    'tournament_id' => $tournament->id,
                    'expiration' => $tournament->registerDateLimit,
                    'active' => 1,
                    'used' => 0,
                ]);

        $invitation = Invite::where('tournament_id', $tournament->id)
            ->where('email', 'john@example.com')
            ->first();


        $user = User::where('email', 'john@example.com')->first();

        //Bad Code or no code
        $this->visit("/tournaments/" . $invitation->tournament_id . "/invite/123456s")
            ->see("No invitation");
        $this->visit("/tournaments/" . $invitation->tournament_id . "/invite/")
            ->see("No invitation");

        $this->visit("/tournaments/" . $invitation->tournament_id . "/invite/" . $invitation->code);
        // If user didn't exit, check that it is created
        if (is_null($user)) {
            // System redirect to user creation
            $this->type('Johnny', 'name')
                ->type('11111111', 'password')
                ->type('11111111', 'password_confirmation')
                ->press(Lang::get('auth.create_account'))
                ->seeInDatabase('users', ['email' => 'john@example.com', 'verified' => '1'])
                ->see(trans('auth.registration_completed'));

        }

        // Get all categories for this tournament
        // Now we are on category Selection page
        foreach ($categoriesTournament as $key => $ct) {
            $this->type($ct->id, 'cat[' . $key . ']');
        }
        $this->press(trans("core.save"));

        foreach ($categoriesTournament as $key => $ct) {
            $this->seeInDatabase('category_tournament_user',
                ['category_tournament_id' => $ct->id,
                    'user_id' => Auth::user()->id,
                ]);
        }
        $this->seePageIs('/invites')
            ->see(htmlentities(Lang::get('core.operation_successful')));

    }

    /** @test */
    public function a_user_may_register_an_open_tournament()
    {

    }
}
