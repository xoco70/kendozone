<?php

class PagesTest extends TestCase
{
    /** @test */
    public function it_loads_the_home_page()
    {
        $this->visit('/')
             ->see('Landing Page');
    }

    /** @test */
    public function it_loads_the_about_page()
    {
        $this->visit('about')
             ->see('About Page');
    }

    /** @test */
    public function it_loads_the_contact_page()
    {
        $this->visit('contact')
             ->see('Contact Page');
    }

    /** @test */
    public function it_loads_the_register_page()
    {
        $this->visit('register')
             ->see('Register');
    }

    /** @test */
    public function it_loads_the_login_page()
    {
        $this->visit('login')
             ->see('Login');
    }

    /** @test */
    public function it_loads_the_forgot_password_page()
    {
        $this->visit('forgot_password')
             ->see('Password Reset');
    }
}
