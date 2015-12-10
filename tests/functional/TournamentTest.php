<?php
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

/**
 * List of User Test
 *
 * it_denies_creating_an_empty_tournament()
 * mustBeAuthenticated()
 * it_create_tournament($delete = true)
 * it_edit_tournament()
 * it_denies_creating_tournament_without_password()
 * it_allow_editing_tournament_without_password()
 *
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
class TournamentTest extends TestCase
{
//    use DatabaseTransactions;
//    use WithoutMiddleware;

    protected $tournament, $tournaments, $addTournament, $editTournament;


    public function setUp()
    {
        parent::setUp();
        $this->tournament = trans_choice('crud.tournament', 1);
        $this->tournaments = trans_choice('crud.tournament', 2);
        $this->addTournament = Lang::get('crud.addModel', ['currentModelName' => $this->tournament]);
        $this->editTournament = Lang::get('crud.updateModel', ['currentModelName' => $this->tournament]);

        Auth::loginUsingId(1); 
    }
    /** @test */
    public function it_denies_creating_an_empty_tournament()
    {
//        $nameMandatory = Lang::get('validation.filled', ['attribute' => "name"]);
//        echo $nameMandatory;
//        assertEquals($nameMandatory , "El campo name es obligatorio");

        $this->visit("/tournaments")
            ->see($this->tournaments)
            ->click("+ ".$this->addTournament)
//            ->press("Next")
//            ->press("Next")
            ->press("Submit")
            ->seePageIs('/tournaments/create')
            ->see("El campo name es obligatorio")  //Lang::get('validation.filled', ['attribute' => "name"])
            ->see("El campo name es obligatorio")  //Lang::get('validation.filled', ['attribute' => "tournament"])
            ->see("El campo venue es obligatorio")  //Lang::get('validation.filled', ['attribute' => "place"])
//            ->see("El campo category es obligatorio")  //Lang::get('validation.filled', ['attribute' => "category"])

            ->notSeeInDatabase('tournament', ['name' => '']);

    }
    /** @test */
    public function mustBeAuthenticated()
    {
        Auth::logout();
        $this->visit('/tournaments')
            ->seePageIs('/auth/login');
    }

    /** @test */
    public function it_create_tournament($delete = true)
    {
        $this->visit('/')
            ->click($this->tournaments)
            ->see($this->tournaments)
            ->click($this->addTournament)
            ->type('MyTournament', 'name')
            ->type('2015-12-12', 'date')
            ->type('2015-12-13', 'registerDateLimit')
            ->type('on', 'mustPay')
            ->type('on', 'type')
            ->type('300', 'cost')
            ->type('2', 'fightingAreas')
            ->type('2', 'levelId')
//            ->press("Next")
            ->type('CDOM', 'venue')
            ->type('1.11111', 'latitude')
            ->type('2.22222', 'longitude')
            ->type('Mexico', 'country')
//            ->press("Next")
//            ->select('[1,2]', 'category[]')
            ->press("Submit")
//            ->dump();
            ->seePageIs('/tournaments')
            ->see(Lang::get('core.success'))
            ->seeInDatabase('tournaments',['name' => 'MyUser']);

        $tournament = User::where('email', '=', "julien@cappiello.fr2")->first();
        if ($delete) $tournament->delete();
    }

//    /** @test */
//    public function it_edit_tournament()
//    {
//        $this->it_create_user(false);
//
//        $this->visit('/users')
//            ->click("MyUser")
//            ->type('juju', 'name')
//            ->type('juju@juju.com', 'email')
//            ->type('may', 'firstname')
//            ->type('1', 'lastname')
//            ->select('1', 'gradeId')
//            ->select('3', 'roleId')
//            ->type('222222', 'password')
//            ->type('222222', 'password_confirmation')
//            ->type('44', 'avatar')
//            ->press($this->editUser)
//            ->seePageIs('/users')
//            ->seeInDatabase('users',['name' => 'juju', 'email' => 'juju@juju.com']);
//
//        $user = User::where('email', '=', "juju@juju.com")->first();
//        $user->delete();
//
//    }
//
//
//    /** @test */
//    public function it_denies_creating_user_without_password()
//    {
//
//        $this->visit('/')
//            ->click($this->users)
//            ->see($this->users)
//            ->click($this->addUser)
//            ->type('MyUser', 'name')
//            ->type('julien@cappiello.fr2', 'email')
//            ->type('julien', 'firstname')
//            ->type('cappiello', 'lastname')
//            ->select('4', 'gradeId')
//            ->select('3', 'roleId')
////            //File input avatar
//            ->press($this->addUser)
//            ->seePageIs('/users/create')
//            ->see(Lang::get('validation.required', ['attribute' => "password"]))
//            ->notSeeInDatabase('users',['name' => 'MyUser']);
//
//    }
//
//    /** @test */
//    public function it_allow_editing_user_without_password()
//    {
//        $this->it_create_user(false);
//        $usuario = User::where('email', '=', "julien@cappiello.fr2")->first();
//        $oldPass = $usuario->password;
//        $this->visit('/users')
//            ->click("MyUser")
//            ->type('juju', 'name')
//            ->type('juju@juju.com', 'email')
//            ->type('may', 'firstname')
//            ->type('1', 'lastname')
//            ->select('1', 'gradeId')
//            ->select('3', 'roleId')
//            ->press($this->editUser)
//            ->seePageIs('/users')
//            ->seeInDatabase('users',['name' => 'juju', 'email' => 'juju@juju.com']);
//
//        $usuario = User::where('email', '=', "juju@juju.com")->first();
//        $newPass = $usuario->password;
//        assert($oldPass == $newPass, true);
//        $usuario->delete();
//
//    }

    /** @test */
//    public function it_delete_user()
//    {
//
//
//        $delete = Lang::get('crud.delete');
//        $this->it_create_user();
//
//        $this->visit('/users')
//            ->click($delete)
//            ->seePageIs('/users')
//            ->dontSee('My User')
//            ->notSeeInDatabase('user', ['name' => 'My User']);
//    }


    /** @test */
//    public function it_see_my_users_as_admin(){
//        $this->login_admin_user()
//            ->visit('users')
//            ->click('Lugar')
//            ->see('Lugares');
//    }
//    /** @test */
//    public function it_see_others_users_as_admin(){
//        $this->login_admin_user()
//            ->visit('users')
//            ->click('Lugar')
//            ->see('Lugares');
//    }


//    /** @test */
//    public function it_doesnt_see_users_as_user(){
//        $this->login_standard_user()
//            ->visit('home');
//    }
//    /** @test */
//    public function it_denies_see_users_as_guest(){
//        $this->visit('users')
//            ->seePageIs('login');
//    }

//phpunit --filter it_create_user tests/functional/UserTest.php
    /** @test */
//    public function it_create_user_as_admin(){
//        // Login as admin
//        $this->login_admin_user()
//            ->visit('users')
//            ->click('+ Agregar Lugar')
//            ->type('1', 'name')
//            ->type('2', 'coords')
//            ->type('3', 'city')
//            ->type('4', 'state')
//            ->press('Agregar Lugar')
//            ->seeInDatabase('user', ['name' => '1', 'coords' => '2','city' => '3', 'state' => '4', 'countryId' => '36'])
//            ->see('Operación Exitosa!');
//    }

//    /** @test */
//    public function it_denies_create_user_as_user(){
//        // Login as admin
//        $this->login_standard_user()
//            ->visit('users/create')
//            ->seePageIs('login');
//    }
    /** @test */
//    public function it_denies_create_user_as_guest(){
//        // Login as admin
//        $this->login_standard_user()
//            ->visit('users/create') // Debe de haber clic por eso no funciona
//            ->seePageIs('login');
//    }

//    /** @test */
//    public function it_edit_user_as_admin(){
//
//    }
//    /** @test */
//    public function it_denies_edit_user_as_user(){
//
//    }
    /** @test */
//    public function it_denies_edit_user_as_guest(){
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

    /** @test */
//    public function login_admin_user()
//    {
//        return $this->visit('auth/login')
//            ->type('john@example.com', 'email')
//            ->type('password', 'password')
//            ->press(Lang::get('auth.signin'));
//    }
}
