<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Lang;

class UserTest extends TestCase
{
    use DatabaseTransactions;

//    /** @test */
//    public function it_registers_a_user()
//    {
//        $this->visit('auth/register')
//            ->type('usuario', 'name')
//            ->type('blah@blah.com', 'email')
//            ->type('password', 'password')
//            ->type('password', 'password_confirmation')
//            ->select('32', 'countryId')
//            ->select('2', 'gradeId')
//            ->press('Register');
////            ->seeInDatabase('users', ['email' => 'blah@blah.com']);
////            ->seePageIs('/');
//    }

    /** @test */
    public function it_denies_an_incorrect_login()
    {
        $this->visit('auth/login')
            ->type('nouser@nouser.com', 'email')
            ->type('password', 'password')
            ->press('Sign in')
            ->seePageIs('auth/login')
            ->see('Estas credenciales no coinciden con nuestros registros.');

    }
//
//    /** @test */
    public function it_logs_in_a_standard_user()
    {
        $this->login_standard_user()
            ->seePageIs('/')
            ->see('user@user.com');
    }

        /** @test */
    public function it_denies_an_standard_user_access()
    {

        $this->login_standard_user();
        $response = $this->call('GET', 'users');
        $this->assertEquals(401, $response->getStatusCode());
        $response = $this->call('GET', 'places');
        $this->assertEquals(401, $response->getStatusCode());
        $response = $this->call('GET', 'tournaments');
        $this->assertEquals(401, $response->getStatusCode());

    }
    /** @test */
        public function it_allows_an_user_to_edit_his_own_information()
    {
        //TODO FAltA Agregar todos los campos del usuario
        // Falla porque toma todos los campos los blancos los pone
        $this->login_admin_user()
            ->seePageIs('/')
            ->visit('users/profile/1')
//            ->click(Lang::get('core.myaccount'));
//            ->click(Lang::get('core.profile'))
            ->type('nameChanged', 'name')
            ->type('email@changed.com', 'email')
            ->type('firstChanged', 'firstname')
            ->type('lastChanged', 'lastname')
            ->press('Guardar cambios')
            ->seeInDatabase('users', ['name' => 'nameChanged',
                                      'email' => 'email@changed.com',
                                      'firstname' => 'firstChanged',
                                      'lastname' => 'lastChanged'])
            ->seePageIs('/')
            ->see('Operación Exitosa!');

        $this->login_standard_user()
            ->seePageIs('/')
            ->visit('users/profile/2')
//            ->click(Lang::get('core.myaccount'));
//            ->click(Lang::get('core.profile'))
            ->type('nameChanged', 'name')
            ->type('email@changed.com', 'email')
            ->type('firstChanged', 'firstname')
            ->type('lastChanged', 'lastname')
            ->press('Guardar cambios')
            ->seeInDatabase('users', ['name' => 'nameChanged',
                'email' => 'email@changed.com',
                'firstname' => 'firstChanged',
                'lastname' => 'lastChanged'])
            ->seePageIs('/')
            ->see('Operación Exitosa!');

    }
    /** @test */
    public function login_standard_user()
    {
        return $this->visit('auth/login')
            ->type('user@user.com', 'email')
            ->type('user', 'password')
            ->press('Sign in');
    }
    /** @test */
    public function login_admin_user()
    {
        return $this->visit('auth/login')
            ->type('admin@admin.com', 'email')
            ->type('admin', 'password')
            ->press('Sign in');
    }
}
