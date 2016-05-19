<?php
use App\User;

$I = new AcceptanceTester($scenario);
$I->wantTo('Register a new account and then I must confirm my email');
App::setLocale('en');
$I->amOnPage('/');
$I->click(trans('auth.signup'));
$user = factory(User::class)->make();
//
$I->fillField('name', $user->name);
$I->fillField('email', $user->email);
$I->fillField('password', '111111');
$I->fillField('password_confirmation', '111111');
$I->click(trans('auth.create_account'));
$I->see(trans('auth.check_your_email'));
$I->seeRecord('users', ['name' => $user->name, 'verified' => 0]);
$user = User::whereName($user->name)->first();
// You can't login until you confirm your email address.
$I->amOnPage('/auth/login');
$I->fillField('email', $user->email);
$I->fillField('password', '111111');
$I->click(trans('auth.signin'));
$I->see(trans('auth.account_not_activated'));

$I->amOnPage('/auth/register/confirm/'.$user->token);
$I->see(trans('auth.tx_for_confirm'));
$I->seeRecord('users', ['name' => $user->name, 'verified' => 1]);
//




//    /** @test */
//    public function a_user_may_register_for_an_account_but_must_confirm_their_email_address()
//    {
//
//        App::setLocale('en');
//        // When we register...
//        $this->visit('/')
//            ->click(trans('auth.signup'))
//            ->type('JohnDoe', 'name')
//            ->type('john@example.com', '')
//            ->type('password', '')
//            ->type('password', 'password_confirmation')
//            ->press(trans('auth.create_account'));
//        // We should have an account - but one that is not yet confirmed/verified.
//        $this->see(htmlentities(trans('auth.check_your_email')))
//            ->seeInDatabase('users', ['name' => 'JohnDoe', 'verified' => 0]);
//        $user = User::whereName('JohnDoe')->first();
//        // You can't login until you confirm your email address.
//        $this->login($user)->see(trans('auth.account_not_activated'));
//        $this->visit("auth/register/confirm/{$user->token}")
//            ->see(trans('auth.tx_for_confirm'))
//            ->seeInDatabase('users', ['name' => 'JohnDoe', 'verified' => 1]);
//
//    }

//    /** @test */
//    public function register_but_error_in_confirmations()
//    {
//        // When we register...
//        $this->visit('/auth/register')
//            ->type('JohnDoe', 'name')
//            ->type('john2@example.com', 'email')
//            ->type('password', 'password')
//            ->type('password2', 'password_confirmation')
//            ->press(trans('auth.create_account'));
//        $this->see(trans('validation.confirmed', ['attribute' => 'password']))
//            ->notSeeInDatabase('users', ['name' => 'JohnDoe', 'email' => 'john2@example.com', 'verified' => 0]);
//    }
//
//    /** @test */
//    public function login($user = null)
//    {
//        $user = $user ?: factory(User::class)->create(['password' => bcrypt('password')]);
//
//        return $this->visit('/auth/login')
//            ->type($user->email, 'email')
//            ->type('password', 'password')
//            ->press(trans('auth.signin'));
//    }
//
//    /** @test */
//    public function lost_password()
//    {
//        // It should verify email is in system
//
//        $user = factory(User::class)->create([
//            'role_id' => Config::get('constants.ROLE_USER'),
//            'verified' => 1,]);
//
//        $this->visit('/auth/login')
//            ->click(trans('auth.lost_password'))
//            ->seePageIs('/password/email')
//            ->type($user->email, 'email')
//            ->press(trans('auth.send_password'))
//            ->seePageIs('/password/email')
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
//            ->type('222222', 'password')
//            ->type('222222', 'password_confirmation')
//            ->press(trans('auth.reset_password'));
//
//        Auth::logout();
//        $this->visit('/auth/login')
//            ->type($user->email, 'email')
//            ->type('222222', 'password')
//            ->press(trans('auth.signin'))
//            ->seePageIs('/');
//
//
//    }
//
//    /** @test */
//    public function remember_me()
//    {
//    }
//
//// I'm not sure how to Test Conexion Facebook
//    /** @test */
//    public function loginWithFB()
//    {
//
//    }
//
//    /** @test */
//    public function loginWithGoogle()
//    {
//        Auth::logout();
//        $this->visit('/auth/login')
//            ->click('google'); // go to "https://accounts.google.com/o/oauth2/auth"
////        dump(Request::url());
////        $this->dump();
////             ->press('choose-account-0');
////        dd(Request::url());
////             ->dump();
//
//    }


//}
?>