<?php


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends BrowserKitTest
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

    }

    public function tearDown()
    {
        DB::rollBack();

    }

    /** @test */
    public function a_user_may_register_for_an_account_but_must_confirm_their_email_address()
    {

        App::setLocale('en');
        $user = factory(User::class)->make();
        // When we register...
        $this->visit('/')
            ->click(trans('auth.signup'))
            ->type($user->name, 'name')
            ->type($user->email, 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press(trans('auth.create_account'));
        // We should have an account - but one that is not yet confirmed/verified.
        $this->see(htmlentities(trans('auth.check_your_email')))
            ->seeInDatabase('users', ['name' => $user->name, 'verified' => 0]);
        $user = User::whereName($user->name)->first();
        // You can't login until you confirm your email address.
        $this->login($user)->see(trans('auth.account_not_activated'));
        $this->visit("register/confirm/".$user->token)
            ->see(trans('auth.tx_for_confirm'))
            ->seeInDatabase('users', ['name' => $user->name, 'verified' => 1]);

    }

    /** @test */
    public function register_but_error_in_confirmations()
    {
        $user = factory(User::class)->make();
        // When we register...
        $this->visit('/register')
            ->type($user->name, 'name')
            ->type($user->email, 'email')
            ->type('password', 'password')
            ->type('password2', 'password_confirmation')
            ->press(trans('auth.create_account'));
        $this->see(trans('validation.confirmed', ['attribute' => 'password']))
            ->notSeeInDatabase('users', ['name' => 'JohnDoe', 'email' => $user->email, 'verified' => 0]);
    }

    /** @test */
    public function login($user = null)
    {
        $user = $user ?: factory(User::class)->create(['password' => bcrypt('password')]);

        return $this->visit('/login')
            ->type($user->email, 'email')
            ->type('password', 'password')
            ->press(trans('auth.signin'));
    }

//    /** @test */
//    public function lost_password()
//    {
//        // It should verify email is in system
//
//        $user = factory(User::class)->create([
//            'role_id' => Config::get('constants.ROLE_USER'),
//            'verified' => 1,]);
//
//        $this->visit('/')
//            ->click(trans('auth.lost_password'))
//            ->seePageIs('/password/reset')
//            ->type($user->email, 'email')
//            ->press(trans('auth.send_password'))
//            ->seePageIs('/password/reset')
//            ->see(trans('passwords.sent'));
//
//        $reset = DB::table('password_resets')->where('email', $user->email)
//            ->orderBy('created_at', 'desc')
//            ->first();
//
//        $this->assertTrue($reset != null);
//
//
//        $this->visit('/password/reset/' . $reset->token)
//            ->type($user->email, 'email')
//            ->type('222222', 'password')
//            ->type('222222', 'password_confirmation')
//            ->press(trans('auth.reset_password'));
//
//        Auth::logout();
//        dd($user);
//        $this->visit('/')
//            ->type($user->email, 'email')
//            ->type('222222', 'password')
//            ->press(trans('auth.signin'))
//            ->seePageIs('/');
//
//
//    }

//    /** @test */
//    public function remember_me()
//    {
//    }
}
