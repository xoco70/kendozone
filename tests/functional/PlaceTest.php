<?php
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Created by PhpStorm.
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
class PlaceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_see_all_places_as_superadmin(){
        $this->visit('places');
    }
    /** @test */
    public function it_see_my_places_as_admin(){
        $this->login_admin_user()
            ->visit('places')
            ->click('Lugar')
            ->see('Lugares');
    }
//    /** @test */
//    public function it_doesnt_see_places_as_user(){
//        $this->login_standard_user()
//            ->visit('home');
//    }
    /** @test */
    public function it_denies_see_places_as_guest(){
        $this->visit('places')
            ->seePageIs('login');
    }

//phpunit --filter it_create_place tests/functional/PlaceTest.php
    /** @test */
    public function it_create_place_as_admin(){
        // Login as admin
        $this->login_admin_user()
            ->visit('places')
            ->click('+ Agregar Lugar')
            ->type('1', 'name')
            ->type('2', 'coords')
            ->type('3', 'city')
            ->type('4', 'state')
            ->select('36', 'countryId')
            ->press('Agregar Lugar')
            ->seeInDatabase('place', ['name' => '1', 'coords' => '2','city' => '3', 'state' => '4', 'countryId' => '36'])
            ->see('Operación Exitosa!');
    }

//    /** @test */
//    public function it_denies_create_place_as_user(){
//        // Login as admin
//        $this->login_standard_user()
//            ->visit('places/create')
//            ->seePageIs('login');
//    }
    /** @test */
//    public function it_denies_create_place_as_guest(){
//        // Login as admin
//        $this->login_standard_user()
//            ->visit('places/create') // Debe de haber clic por eso no funciona
//            ->seePageIs('login');
//    }

    /** @test */
    public function it_edit_place_as_admin(){

    }
    /** @test */
    public function it_denies_edit_place_as_user(){

    }
    /** @test */
    public function it_denies_edit_place_as_guest(){

    }


    protected function login_admin_user()
    {
        return $this->visit('login')
            ->type('admin@admin.com', 'email')
            ->type('sentineladmin', 'password')
            ->press('Login');
    }

    protected function login_standard_user()
    {
        return $this->visit('login')
            ->type('user@user.com', 'email')
            ->type('sentineluser', 'password')
            ->press('Login');
    }
}
