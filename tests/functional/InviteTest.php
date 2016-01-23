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
     * 0. Generate an invite with key
     * 1. Send mails and success
     * 2. Click mail and add to tournament
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
    public function an_admin_may_invite_a_user_but_user_must_register_after()
    {
        $tournament = factory(Tournament::class)->create();
        factory(CategoryTournament::class,5)->create(['tournament_id' => $tournament->id]);

        // When we register...
        $this->visit('/tournaments/'.$tournament->id.'/invite')
            ->type('["john@example.com"]', 'recipients') // Must simulate js plugin
            ->press(trans('crud.send_invites'))
            ->seePageIs('/tournaments/'.$tournament->id.'/edit')
            ->seeInDatabase('invitation',
                ['email' => 'john@example.com',
                 'tournament_id' => $tournament->id,
                 'expiration' =>$tournament->registerDateLimit,
                 'active' =>1,
                 'used' =>0,
                ]);

        $invitation = Invite::where('tournament_id',$tournament->id)
                                   ->where('email','john@example.com' )->get();
        $user = User::where('email', 'john@example.com' )->first();
        if (is_null($user)){
            $this->visit("/invite/register/$invitation->code");
        }
//        // You can't login until you confirm your email address.
//        $this->login($user)->see(Lang::get('auth.account_not_activated'));
//        $this->visit("auth/register/confirm/{$user->token}")
//            ->see(Lang::get('auth.tx_for_confirm'))
//            ->seeInDatabase('users', ['name' => 'JohnDoe', 'verified' => 1]);

        // Reset this user
//            $user->delete();

    }
    /** @test */
    public function an_admin_may_invite_several_users_but_user_must_register_after()
    {

    }

    /** @test */
    public function it_generate_an_invite()
    {

    }

    public function user_register_a_tournament()
    {

    }

}
