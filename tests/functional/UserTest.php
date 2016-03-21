<?php
use App\CategorySettings;
use App\CategoryTournament;
use App\CategoryTournamentUser;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

/**
 * List of User Test
 *
 * it_denies_creating_an_empty_user()
 * mustBeAuthenticated()
 * it_create_user($delete = true)
 * it_edit_user()
 * it_denies_creating_user_without_password()
 * it_allow_editing_user_without_password()
 * you_must_be_the_user_to_edit_your_info_or_be_superuser()
 * check_you_can_see_user_info ( TODO )
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
        $this->editUser = Lang::get('crud.updateModel', ['currentModelName' => $this->user]);

        Auth::loginUsingId(1);
    }

    /** @test */
    public function it_denies_creating_an_empty_user()
    {
        $this->visit("/users")
            ->see($this->users)
            ->click($this->addUser)
            ->press(Lang::get('core.save'))
            ->seePageIs('/users/create')
            ->see("El campo name es obligatorio")// Lang::get('validation.filled', ['attribute' => "name"])
            ->see("El campo email es obligatorio")// Lang::get('validation.filled', ['attribute' => "email"])
            ->see("El campo password es obligatorio")//Lang::get('validation.filled', ['attribute' => "password"])
            ->notSeeInDatabase('users', ['name' => '']);

    }

    /** @test */
    public function mustBeAuthenticated()
    {
        Auth::logout();
        $this->visit('/users')
            ->seePageIs('/auth/login');
    }

    /** @test */
    public function it_create_user($delete = true)
    {
//given
        $test_file_path = base_path() . '/avatar2.png';
//        dd($test_file_path);
        $this->assertTrue(file_exists($test_file_path), 'Test file does not exist');


        $this->visit('/')
            ->click($this->users)
            ->see($this->users)
            ->click($this->addUser)
            ->type('MyUser', 'name')
            ->type('julien@cappiello.fr2', 'email')
            ->type('julien', 'firstname')
            ->type('cappiello', 'lastname')
            ->select('111111', 'password')
            ->select('111111', 'password_confirmation')
            ->attach($test_file_path, 'avatar')
//            //File input avatar
            ->press(Lang::get('core.save'))
            ->seePageIs('/users')
            ->see(Lang::get('core.success'))
            ->seeInDatabase('users', ['name' => 'MyUser']);

        $user = User::where('name', 'MyUser')->first();
        File::delete(base_path() . '/'.$user->avatar);

    }

    /** @test */
    public function it_edit_user()
    {
        $user = factory(User::class)->create(['name' => 'MyUser']);

        $this->visit('/users')
            ->click("MyUser")
            ->type('juju', 'name')
            ->type('juju@juju.com', 'email')
            ->type('may', 'firstname')
            ->type('1', 'lastname')
//            ->select('3', 'role_id')  //TODO esto va a cambiar cuando haya federaciones
            ->type('222222', 'password')
            ->type('222222', 'password_confirmation')
            ->type('44', 'avatar')
            ->press(Lang::get('core.save'))
            ->seePageIs('/users/')
            ->seeInDatabase('users', ['name' => 'juju', 'email' => 'juju@juju.com']);

//        $user = User::where('email', '=', "juju@juju.com")->first();
//        $user->delete();

    }


    /** @test */
    public function it_denies_creating_user_without_password()
    {

        $this->visit('/')
            ->click($this->users)
            ->see($this->users)
            ->click($this->addUser)
            ->type('MyUser', 'name')
            ->type('julien@cappiello.fr3', 'email')
            ->type('julien', 'firstname')
            ->type('cappiello', 'lastname')
//            ->select('3', 'role_id')
//            //File input avatar
            ->press(Lang::get('core.save'))
            ->seePageIs('/users/create')
            ->see(Lang::get('validation.required', ['attribute' => "password"]))
            ->notSeeInDatabase('users', ['name' => 'MyUser']);

    }

    /** @test */
    public function it_allow_editing_user_without_password()
    {
//        $this->it_create_user(false);
        $user = factory(User::class)->create(
            [   'name' => 'MyUser',
                'email' => 'MyUser@kendozone.com',
                'role_id' => 3,
                'password' => bcrypt('111111'),
                'verified' => 1,]);

//        $user = User::where('email', '=', )->first();
        $oldPass = $user->password;
        $this->visit('/users')
            ->click("MyUser")
            ->type('juju', 'name')
            ->type('juju@juju.com', 'email')
            ->type('may', 'firstname')
            ->type('1', 'lastname')
//            ->select('3', 'role_id')
            ->press(Lang::get('core.save'))
            ->seePageIs('/users/')
            ->seeInDatabase('users', ['name' => 'juju', 'email' => 'juju@juju.com']);

        // Check that password remains unchanged
        $user = User::where('email', '=', "juju@juju.com")->first();
        $newPass = $user->password;
        assert($oldPass == $newPass, true);

    }

    /** @test */
    public function it_delete_user()
    {
        // Given
        $user = factory(User::class)->create(['name'=>'MyKendoUser']);
        $this->seeInDatabase('users',['name' => 'MyKendoUser']);

        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => $user->id]);
        $ct1 = factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
        factory(CategorySettings::class)->create(['category_tournament_id' => $ct1->id]);
        factory(CategoryTournamentUser::class)->create(['category_tournament_id' => $ct1->id]);


        $this->visit('/users')
            ->press('delete_'.$user->slug)
//            ->seePageIs('/users')
            ->seeIsSoftDeletedInDatabase('users',['name' => 'MyKendoUser'])
            ->seeIsSoftDeletedInDatabase('tournament',['user_id' => $user->id])
            ->seeIsSoftDeletedInDatabase('category_tournament',['id' => $ct1->id])
            ->seeIsSoftDeletedInDatabase('category_settings', ['category_tournament_id' => $ct1->id])
            ->seeIsSoftDeletedInDatabase('category_tournament_user', ['category_tournament_id' => $ct1->id]);

        ;

    }


    /** @test */
    public function you_must_be_the_user_to_edit_your_info_or_be_superuser()
    {
        // User 2 can edit his info
        Auth::loginUsingId(2);
        $user = Auth::user();
        $this->visit('/users/'.$user->slug.'/edit')
        ->see($this->user);

        // Now superuser can also edit User 2 Info
        Auth::loginUsingId(1);
        $this->visit('/users/'.$user->slug.'/edit')
            ->see($this->user);

        //Now superuser cannot edit User 2 info
        Auth::loginUsingId(3);
        $this->visit('/users/' . $user->slug . '/edit')
            ->see("403");

    }

    /** @test */
    public function check_you_can_see_user_info()
    {

    }
}
