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


    protected $user, $users, $addUser, $editUser, $root, $simpleUser;

    public function setUp()
    {
        parent::setUp();

        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $this->simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

        $this->user = trans_choice('core.user', 1);
        $this->users = trans_choice('core.user', 2);
        $this->addUser = Lang::get('core.addModel', ['currentModelName' => $this->user]);
        $this->editUser = Lang::get('core.updateModel', ['currentModelName' => $this->user]);
    }

    /** @test */
    public function it_denies_creating_an_empty_user()
    {

        Auth::loginUsingId($this->simpleUser->id);

        $this->visit("/users")
             ->see('403');

        Auth::loginUsingId($this->root->id);

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
        $this->visit('/users')
            ->seePageIs('/auth/login');
    }

    /** @test */
    public function it_create_user($delete = true)
    {
        Auth::loginUsingId($this->simpleUser->id);
        $this->visit('/')->dontSee($this->users);


        Auth::loginUsingId($this->root->id);

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


        Auth::loginUsingId($this->simpleUser->id);
        $this->visit('/')->dontSee($this->users);


        Auth::loginUsingId($this->root->id);


        $this->visit('/users')
            ->click($this->simpleUser->name)
            ->type('juju', 'name')
            ->type('juju@juju.com', 'email')
            ->type('may', 'firstname')
            ->type('1', 'lastname')
            ->type('222222', 'password')
            ->type('222222', 'password_confirmation')
            ->type('44', 'avatar')
            ->press(Lang::get('core.save'))
            ->seePageIs('/users/')
            ->seeInDatabase('users', ['name' => 'juju', 'email' => 'juju@juju.com']);

    }


    /** @test */
    public function it_denies_creating_user_without_password()
    {
        Auth::loginUsingId($this->simpleUser->id);
        $this->visit('/')->dontSee($this->users);


        Auth::loginUsingId($this->root->id);

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
        Auth::loginUsingId($this->root->id);

        $user = factory(User::class)->create(
            [   'name' => 'MyUser',
                'email' => 'MyUser@kendozone.com',
                'role_id' => Config::get('constants.ROLE_USER'),
                'password' => bcrypt('111111'),
                'verified' => 1,]);

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
        Auth::loginUsingId($this->root->id);
        // Given

        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => $this->simpleUser->id]);
        $ct1 = factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
        factory(CategorySettings::class)->create(['category_tournament_id' => $ct1->id]);
        factory(CategoryTournamentUser::class)->create(['category_tournament_id' => $ct1->id]);


        $this->visit('/users')
            ->press('delete_'.$this->simpleUser->slug)
//            ->seePageIs('/users')
            ->seeIsSoftDeletedInDatabase('users',['name' => $this->simpleUser->name])
            ->seeIsSoftDeletedInDatabase('tournament',['user_id' => $this->simpleUser->id])
            ->seeIsSoftDeletedInDatabase('category_tournament',['id' => $ct1->id])
            ->seeIsSoftDeletedInDatabase('category_settings', ['category_tournament_id' => $ct1->id])
            ->seeIsSoftDeletedInDatabase('category_tournament_user', ['category_tournament_id' => $ct1->id]);

        ;

    }


    /** @test */
    public function you_must_be_the_user_to_edit_your_info_or_be_superuser()
    {
        $owner = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

        // User 2 can edit his info
        Auth::loginUsingId($owner->id);
        $this->visit('/users/'.$owner->slug.'/edit')
        ->see($this->user);

        // Now superuser can also edit User 2 Info
        Auth::loginUsingId($this->root->id);
        $this->visit('/users/'.$this->simpleUser->slug.'/edit')
            ->see($this->user);

        //Now superuser cannot edit User 2 info
        Auth::loginUsingId($this->simpleUser->id);
        $this->visit('/users/' . $owner->slug . '/edit')
            ->see("403");

    }

    /** @test
     * TODO Map seems not to work in user.show
     */
    public function check_you_can_see_user_info()
    {
        $user2 = factory(User::class)->create(['name'=>'AnotherUser' ]);

        Auth::loginUsingId($this->simpleUser->id);
        $this->visit('/users/'.$user2->slug)
            ->dontSee("403")
            ->visit('/users/'.$user2->slug.'/edit')
            ->see("403");
//            $this->visit('/users/'.$user->slug.'/edit')
    }

    /** @test
     * TODO Map seems not to work in user.show
     */
    public function user_can_see_tournament_info_but_cannot_edit_it()
    {
        $owner = factory(User::class)->create(['name'=>'AnotherUser' ]);

        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => $owner->id]);

        Auth::loginUsingId($this->simpleUser->id);

        $this->visit('/tournaments/'.$tournament->slug)
            ->dontSee("403")
            ->visit('/tournaments/'.$tournament->slug.'/edit')
            ->see("403");
//            $this->visit('/users/'.$user->slug.'/edit')
    }
}
