<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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

    }

    /** @test */
    public function an_admin_may_invite_a_user_but_user_must_register_after()
    {
        // When we register...
        $this->visit('/auth/register')
            ->type('JohnDoe', 'name')
            ->type('john@example.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press(Lang::get('auth.create_account'));
        // We should have an account - but one that is not yet confirmed/verified.
        $this->see(htmlentities(Lang::get('auth.check_your_email')))
            ->seeInDatabase('users', ['name' => 'JohnDoe', 'verified' => 0]);
        $user = User::whereName('JohnDoe')->first();
        // You can't login until you confirm your email address.
        $this->login($user)->see(Lang::get('auth.account_not_activated'));
        $this->visit("auth/register/confirm/{$user->token}")
            ->see(Lang::get('auth.tx_for_confirm'))
            ->seeInDatabase('users', ['name' => 'JohnDoe', 'verified' => 1]);

        // Reset this user
//            $user->delete();

    }


    /** @test */
    public function it_generate_an_invite()
    {

    }

    public function user_register_a_tournament()
    {

    }

}
