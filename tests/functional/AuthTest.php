<?php


use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;


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
//        $faker = Faker::create();
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
    public function register_but_error_in_confirmations()
    {
        // When we register...
        $this->visit('/auth/register')
            ->type('JohnDoe', 'name')
            ->type('john2@example.com', 'email')
            ->type('password', 'password')
            ->type('password2', 'password_confirmation')
            ->press(Lang::get('auth.create_account'));
        $this->see(Lang::get('validation.confirmed', ['attribute' => 'password']))
            ->notSeeInDatabase('users', ['name' => 'JohnDoe', 'email' => 'john2@example.com', 'verified' => 0]);
    }

    /** @test */
    public function login($user = null)
    {
        $user = $user ?: factory(User::class)->create(['password' => bcrypt('password')]);

        return $this->visit('/auth/login')
            ->type($user->email, 'email')
            ->type('password', 'password')
            ->press(Lang::get('auth.signin'));
    }

    /** @test */
    public function lost_password()
    {
        // It should verify email is in system

        $user = factory(User::class)->create([
            'role_id' => 3,
            'verified' => 1,]);

        $this->visit('/auth/login')
            ->click(trans('auth.lost_password'))
            ->seePageIs('/password/email')
            ->type($user->email, 'email')
            ->press(Lang::get('auth.send_password'))
            ->seePageIs('/password/email')
            ->see(Lang::get('passwords.sent'));

        $reset = DB::table('password_resets')->where('email', $user->email)
            ->orderBy('created_at', 'desc')
            ->first();

        $this->assertTrue($reset != null);


        $this->visit('/password/reset/' . $reset->token)
            ->type('222222', 'password')
            ->type('222222', 'password_confirmation')
            ->press(Lang::get('auth.reset_password'));

        Auth::logout();
        $this->visit('/auth/login')
            ->type($user->email, 'email')
            ->type('222222', 'password')
            ->press(Lang::get('auth.signin'))
            ->seePageIs('/admin');


    }

    /** @test */
    public function remember_me()
    {
    }

// I'm not sure how to Test Conexion Facebook
    /** @test */
    public function loginWithFB()
    {

    }

    /** @test */
    public function loginWithGoogle()
    {
    }


}
