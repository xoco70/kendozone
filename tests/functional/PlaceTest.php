<?php
//use Illuminate\Foundation\Testing\DatabaseTransactions;
//use Illuminate\Foundation\Testing\WithoutMiddleware;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Lang;

/**
 * Created by PhpStorm.
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
//class PlaceTest extends TestCase
//{
//    use DatabaseTransactions;
////    use WithoutMiddleware;
//
//    protected  $place,$places, $addPlace, $editPlace;
//    public function setUp()
//    {
//        parent::setUp();
//        $this->place = trans_choice('crud.place', 1);
//        $this->places = trans_choice('crud.place', 2);
//        $this->addPlace = Lang::get('crud.addModel', ['currentModelName' => $this->place]);
//        $this->editPlace= Lang::get('crud.updateModel', ['currentModelName' => $this->place]);
//        Auth::loginUsingId(1);
//
//    }
//
//
//    public function mustBeAuthenticated()
//    {
//        Auth::logout();
//        $this->visit('/places')
//            ->seePageIs('/auth/login');
//    }
//
//
//    public function it_denies_creating_an_empty_place(){
//        $this->click($this->places)
//            ->see($this->places)
//            ->click($this->place)
//            ->press("+ ".$this->addPlace)
//            ->seePageIs('/places/create')
//            ->see(Lang::get('validation.filled', ['attribute' => "name"]))
//            ->notSeeInDatabase('place',['name' => 'My Place']);
//
//    }
//
//    /** @test */
//    public function it_create_place()
//    {
//        $this->visit("/")
//            ->click($this->places)
//            ->see($this->places)
//            ->click("+ ".$this->addPlace)
//            ->type('My Place', 'name')
//            ->type('2', 'coords')
//            ->type('3', 'city')
//            ->type('4', 'state')
//            ->select('10','countryId')
//            ->press($this->addPlace)
//            ->seePageIs('/places')
//            ->seeInDatabase('place',['name' => 'My Place']);
//
//    }
//
//    /** @test */
//    public function it_edit_place()
//    {
//        $place = trans_choice('crud.place', 1);
//
//        $edit = Lang::get('crud.edit');
//        $this->it_create_place();
//
//        $this->visit('/places')
//            ->click($edit)
//            ->type('My Place', 'name')
//            ->type('22', 'coords')
//            ->type('33', 'city')
//            ->type('44', 'state')
//            ->select('36','countryId')
//            ->press($this->editPlace)
//            ->seePageIs('/places')
//            ->seeInDatabase('place',['name' => 'My Place', 'coords' => '22']);
//
//    }

// No se porque funciona

//    /** @test */
//    public function it_delete_place()
//    {
//
//
//        $delete = Lang::get('crud.delete');
//        $this->it_create_place();
//
//        $this->visit('/places')
//            ->click($delete)
//            ->dontSee('My Place')
//            ->notSeeInDatabase('place', ['name' => 'My Place']);
//    }



    /** @test */
//    public function it_see_my_places_as_admin(){
//        $this->login_admin_user()
//            ->visit('places')
//            ->click('Lugar')
//            ->see('Lugares');
//    }
//    /** @test */
//    public function it_see_others_places_as_admin(){
//        $this->login_admin_user()
//            ->visit('places')
//            ->click('Lugar')
//            ->see('Lugares');
//    }


//    /** @test */
//    public function it_doesnt_see_places_as_user(){
//        $this->login_standard_user()
//            ->visit('home');
//    }
//    /** @test */
//    public function it_denies_see_places_as_guest(){
//        $this->visit('places')
//            ->seePageIs('login');
//    }

//phpunit --filter it_create_place tests/functional/PlaceTest.php
    /** @test */
//    public function it_create_place_as_admin(){
//        // Login as admin
//        $this->login_admin_user()
//            ->visit('places')
//            ->click('+ Agregar Lugar')
//            ->type('1', 'name')
//            ->type('2', 'coords')
//            ->type('3', 'city')
//            ->type('4', 'state')
//            ->select('36', 'countryId')
//            ->press('Agregar Lugar')
//            ->seeInDatabase('place', ['name' => '1', 'coords' => '2','city' => '3', 'state' => '4', 'countryId' => '36'])
//            ->see('Operación Exitosa!');
//    }

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

//    /** @test */
//    public function it_edit_place_as_admin(){
//
//    }
//    /** @test */
//    public function it_denies_edit_place_as_user(){
//
//    }
    /** @test */
//    public function it_denies_edit_place_as_guest(){
//
//    }
//
//
//    protected function login_superadmin_user()
//    {
//        return $this->visit('login')
//            ->type('superadmin@admin.com', 'email')
//            ->type('superadmin', 'password')
//            ->press('Login');
//    }
//
//    protected function login_owner_user()
//    {
//        return $this->visit('login')
//            ->type('owner@admin.com', 'email')
//            ->type('owner', 'password')
//            ->press('Login');
//    }
//
//    protected function login_admin_user()
//    {
//        return $this->visit('login')
//            ->type('admin@admin.com', 'email')
//            ->type('sentineladmin', 'password')
//            ->press('Login');
//    }
//
//    protected function login_moderator_user()
//    {
//        return $this->visit('login')
//            ->type('moderator@admin.com', 'email')
//            ->type('moderator', 'password')
//            ->press('Login');
//    }
//
//    protected function login_standard_user()
//    {
//        return $this->visit('login')
//            ->type('user@user.com', 'email')
//            ->type('sentineluser', 'password')
//            ->press('Login');
//    }

//    /** @test */
//    public function login_admin_user()
//    {
//        return $this->visit('auth/login')
//            ->type('john@example.com', 'email')
//            ->type('password', 'password')
//            ->press(Lang::get('auth.signin'));
//    }
//}
