<?php
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

/**
 * Created by PhpStorm.
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
class UserTest extends TestCase
{
    use DatabaseTransactions;
//    use WithoutMiddleware;


    protected $user, $users, $addUser, $editUser;

    public function setUp()
    {
        parent::setUp();
        $this->user = trans_choice('crud.user', 1);
        $this->users = trans_choice('crud.user', 2);
        $this->addUser = Lang::get('crud.addModel', ['currentModelName' => $this->user]);

        Auth::loginUsingId(1);
    }

    public function it_denies_creating_an_empty_user()
    {
        $this->click($this->users)
            ->see($this->users)
            ->click("+ ".$this->addUser)
            ->press($this->user)
            ->seePageIs('/users/create')
            ->see(Lang::get('validation.filled', ['attribute' => "name"]))
            ->see(Lang::get('validation.filled', ['attribute' => "email"]))

            ->notSeeInDatabase('users', ['name' => '']);

    }

    public function testMustBeAuthenticated()
    {
        Auth::logout();
        $this->visit('/users')
            ->seePageIs('/auth/login');
    }

    /** @test */
    public function it_create_user()
    {

        $this->visit('/')
            ->click($this->users)
            ->see($this->users)
            ->click($this->addUser)
            ->type('My User', 'name')
            ->type('julien@cappiello.fr', 'email')
            ->type('julien', 'firstname')
            ->type('cappiello', 'lastname')
            ->select('10', 'countryId')
            ->select('4', 'gradeId')
            ->select('3', 'roleId')
            ->select('111111', 'password')
            ->select('111111', 'password_confirmation')
            ->select('avatar.png', 'avatar')
//            //File input avatar
            ->press($this->addUser)
            ->seePageIs('/users')
            ->see(Lang::get('core.success'))
            ->seeInDatabase('users',['name' => 'My User']);

        $user = User::where('email', '=', "julien@cappiello.fr");
        $user->delete();
    }

    /** @test */
    public function it_edit_user()
    {
        $user = trans_choice('crud.user', 1);

        $editUser = Lang::get('crud.updateModel', ['currentModelName' => $user]);
        $edit = Lang::get('crud.edit');
        $this->it_create_user();

        $this->visit('/users')
            ->click($edit)
            ->type('juju', 'name')
            ->type('juju@juju.com', 'email')
            ->type('may', 'firstname')
            ->type('1', 'lastname')
            ->select('36','countryId')
            ->select('1', 'gradeId')
            ->select('3', 'roleId')
            ->type('222222', 'password')
            ->type('222222', 'password_confirmation')
            ->type('44', 'avatar')


            ->press($editUser)
            ->seePageIs('/users')
            ->seeInDatabase('users',['name' => 'juju', 'email' => 'juju@juju.com']);


    }

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
//            ->select('36', 'countryId')
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
