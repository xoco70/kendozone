<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Sentinel;

class AuthTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function it_registers_a_user()
    {
        $this->visit('register')
             ->type('blah@blah.com', 'email')
             ->type('password', 'password')
             ->type('password', 'password_confirmation')
             ->type('Andre', 'first_name')
             ->type('Madarang', 'last_name')
             ->press('Create Account')
             ->seeInDatabase('users', ['email' => 'blah@blah.com'])
             ->seePageIs('login');
    }

    /** @test */
    public function it_does_not_register_an_exisiting_user()
    {
        $this->visit('register')
             ->type('user@user.com', 'email')
             ->type('password', 'password')
             ->type('password', 'password_confirmation')
             ->type('Andre', 'first_name')
             ->type('Madarang', 'last_name')
             ->press('Create Account')
             ->seePageIs('register')
             ->see('email has already been taken');
    }

    // removed because mailer might not be setup on most people's local machine
    // /** @test */
    // public function it_finds_an_email_for_forgot_password()
    // {
    //     $this->visit('forgot_password')
    //          ->type('user@user.com', 'email')
    //          ->press('Send Password Reset Link')
    //          ->seePageIs('forgot_password')
    //          ->see('We have e-mailed your password reset link');
    // }

    /** @test */
    // public function it_does_not_find_an_email_for_forgot_password()
    // {
    //     $this->visit('forgot_password')
    //          ->type('nouser@nouser.com', 'email')
    //          ->press('Send Password Reset Link')
    //          ->seePageIs('forgot_password')
    //          //escaping the ' doesn't seem to work
    //          ->see('can&#039;t find a user with that e-mail address.');
    // }



    /** @test */
    public function it_denies_an_incorrect_login()
    {
        $this->visit('login')
             ->type('nouser@nouser.com', 'email')
             ->type('password', 'password')
             ->press('Login')
             ->seePageIs('login')
             ->see('Invalid Credentials Provided');

    }

    /** @test */
    public function it_logs_in_a_standard_user()
    {
        $this->login_standard_user()
             ->click('Registered Users Only')
             ->see('This is for standard users only');
    }

    /** @test */
    public function it_allows_a_standard_user_to_edit_own_information()
    {

        $this->login_standard_user()
             ->click('My Profile')
             ->click('Edit your Profile')
             ->type('firstChanged', 'first_name')
             ->type('lastChanged', 'last_name')
             ->press('Update Profile')
             ->seeInDatabase('users', ['first_name' => 'firstChanged', 'last_name' => 'lastChanged'])
             ->see('User has been updated successfully');
    }

    /** @test */
    public function it_allows_a_standard_user_to_edit_own_information_and_password()
    {
        $this->login_standard_user()
             ->click('My Profile')
             ->click('Edit your Profile')
             ->type('firstChanged', 'first_name')
             ->type('lastChanged', 'last_name')
             ->type('passwordnew', 'password')
             ->type('passwordnew', 'password_confirmation')
             ->press('Update Profile')
             ->seeInDatabase('users', ['first_name' => 'firstChanged', 'last_name' => 'lastChanged'])
             ->see('User (and password) has been updated successfully');
    }

    /** @test */
    public function it_denies_a_standard_user_access_to_another_account()
    {
        $this->login_standard_user()
             ->click('My Profile')
             ->visit('profiles/2')
             ->seePageIs('profiles/' . Sentinel::getUser()->id)
             ->visit('profiles/2/edit')
             ->seePageIs('profiles/' . Sentinel::getUser()->id);
    }

    /** @test */
    public function it_denies_a_standard_user_access_to_admin_account()
    {
        $this->login_standard_user()
             ->visit('admin')
             ->seePageIs('/');
    }

    /** @test */
    public function it_denies_a_standard_user_access_to_login_page()
    {
        $this->login_standard_user()
             ->visit('login')
             ->seePageIs('/');
    }

    /** @test */
    public function it_denies_a_standard_user_access_to_register_page()
    {
        $this->login_standard_user()
             ->visit('register')
             ->seePageIs('/');
    }

    /** @test */
    public function it_denies_a_standard_user_access_to_forgot_password_page()
    {
        $this->login_standard_user()
             ->visit('forgot_password')
             ->seePageIs('/');
    }

    /** @test */
    public function it_logs_in_an_admin_user()
    {
        $this->login_admin_user()
             ->seePageIs('admin');
    }

    /** @test */
    public function it_allows_an_admin_user_to_edit_own_information()
    {
        $this->login_admin_user()
             ->click('List Users')
             ->click('admin@admin.com')
             ->click('Edit Profile')
             ->type('firstChanged', 'first_name')
             ->type('lastChanged', 'last_name')
             ->press('Update Profile')
             ->seeInDatabase('users', ['first_name' => 'firstChanged', 'last_name' => 'lastChanged'])
             ->see('User has been updated successfully');

    }

    /** @test */
    public function it_allows_an_admin_user_to_edit_another_users_information()
    {
        $this->login_admin_user()
             ->click('List Users')
             ->click('user@user.com')
             ->click('Edit Profile')
             ->select('2', 'account_type')
             ->type('user@user.com', 'email')
             ->type('firstChanged', 'first_name')
             ->type('lastChanged', 'last_name')
             ->press('Update Profile')
             ->seeInDatabase('users', ['first_name' => 'firstChanged', 'last_name' => 'lastChanged'])
             ->seeInDatabase('role_users', ['user_id' => 1, 'role_id' => 2])
             ->see('User has been updated successfully');
    }

    /** @test */
    public function it_denies_an_admin_user_access_to_home_page()
    {
        $this->login_admin_user()
             ->visit('/')
             ->seePageIs('admin');
    }

    /** @test */
    public function it_denies_an_admin_user_access_to_about_page()
    {
        $this->login_admin_user()
             ->visit('about')
             ->seePageIs('admin');
    }

    /** @test */
    public function it_denies_an_admin_user_access_to_contact_page()
    {
        $this->login_admin_user()
             ->visit('contact')
             ->seePageIs('admin');
    }


    protected function login_standard_user()
    {
        return $this->visit('login')
                    ->type('user@user.com', 'email')
                    ->type('sentineluser', 'password')
                    ->press('Login');
    }

    protected function login_admin_user()
    {
        return $this->visit('login')
                    ->type('admin@admin.com', 'email')
                    ->type('sentineladmin', 'password')
                    ->press('Login');
    }


}
