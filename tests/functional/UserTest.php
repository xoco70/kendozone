<?php
use App\Association;
use App\Championship;
use App\ChampionshipSettings;
use App\Club;
use App\Competitor;
use App\Federation;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    protected $user, $users, $root, $simpleUser; // $addUser,  $editUser,

    public function setUp()
    {
        parent::setUp();
        $this->simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
    }

    /** @test */
    public function it_denies_creating_an_empty_user()
    {
        $this->logWithUser($this->root);

        $this->visit("/users/create")
            ->press(trans('core.save'))
            ->seePageIs('/users/create')
            ->see(trans('validation.filled', ['attribute' => "name"]))
            ->see(trans('validation.filled', ['attribute' => "email"]))
            ->see(trans('validation.filled', ['attribute' => "password"]));

    }

    /** @test */
    public function mustBeAuthenticated()
    {
        $this->visit('/users')
            ->seePageIs('/login');
    }


    /** @test */
    public function it_denies_creating_user_without_password()
    {
        $this->logWithUser($this->root);

        $user = new User;
        $user->name = "MyUser";
        $user->email = "julien@cappiello.fr3";
        $user->firstname = 'julien';
        $user->lastname = "cappiello";

        $arrUser = json_decode(json_encode($user), true);

        $this->json('POST', '/users/create', $arrUser);

        $this->notSeeInDatabase('users', ['name' => 'MyUser']);

    }


    /** @test */
    public function it_delete_user()
    {
        $this->logWithUser($this->root);
        // Given

        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => $this->simpleUser->id]);
        $ct1 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
        factory(ChampionshipSettings::class)->create(['championship_id' => $ct1->id]);
        factory(Competitor::class)->create(['championship_id' => $ct1->id]);

        $response = $this->call('DELETE', '/users/' . $this->simpleUser->slug);
        $this->assertEquals(200, $response->status());


        $this->seeIsSoftDeletedInDatabase('users', ['name' => $this->simpleUser->name])
            ->seeIsSoftDeletedInDatabase('tournament', ['user_id' => $this->simpleUser->id])
            ->seeIsSoftDeletedInDatabase('championship', ['id' => $ct1->id])
            ->seeIsSoftDeletedInDatabase('championship_settings', ['championship_id' => $ct1->id])
            ->seeIsSoftDeletedInDatabase('competitor', ['championship_id' => $ct1->id]);;

    }


    /** @test */
    public function you_must_be_the_user_to_edit_your_info_or_be_superuser()
    {
        $owner = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

        // User 2 can edit his info
        $this->logWithUser($owner);
        $this->visit('/users/' . $owner->slug . '/edit')
            ->see(trans_choice('core.user', 1));

        // Now superuser can also edit User 2 Info
        $this->logWithUser($this->root);
        $this->visit('/users/' . $this->simpleUser->slug . '/edit')
            ->see(trans_choice('core.user', 1));

        //Now superuser cannot edit User 2 info
        $this->logWithUser($this->simpleUser);
        $this->visit('/users/' . $owner->slug . '/edit')
            ->see("403");

    }

    /** @test
     */
    public function check_you_can_see_user_info()
    {
        $user2 = factory(User::class)->create(['name' => 'AnotherUser']);

        $this->logWithUser($this->simpleUser);
        $this->visit('/users/' . $this->simpleUser->slug)
            ->dontSee("403")
            ->visit('/users/' . $user2->slug . '/edit')
            ->see("403");
    }


    /** @test */
    public function create_user()
    {
        $this->logWithUser($this->root);
        $user = factory(User::class)->make(['role_id' => Config::get('constants.ROLE_USER')]);
        $arrUser = json_decode(json_encode($user), true);

        $this->json('POST', '/users', $arrUser)
            ->seeInDatabase('users', $arrUser);

    }


    /** @test */
    public function edit_user()
    {

        $this->logWithUser($this->simpleUser);

        $newUser = factory(User::class)->make(['role_id' => Config::get('constants.ROLE_USER')]);
        $arrNewUser = json_decode(json_encode($newUser), true);

        $this->json('PUT', '/users/' . $this->simpleUser->slug, $arrNewUser)
            ->seeInDatabase('users', $arrNewUser);
    }


    /** @test */
    public function it_changes_user_club()
    {

        $this->logWithUser($this->simpleUser);
        $newUser = factory(User::class)->make(['role_id' => Config::get('constants.ROLE_USER')]);

//        $federation = Federation::inRandomOrder()->first();
        $federation = Federation::inRandomOrder()->find(36);
//        $association = Association::inRandomOrder()->where('federation_id', $federation->id)->first();
        $association = Association::find(8); // UNAM
        $club = Club::find(13); // UNAM

        if ($association != null) $club = Club::inRandomOrder()->where('association_id', $association->id)->first();


//        array_add($arrNewUser, 'federation_id',$federation->id);
        $newUser->federation_id = $federation->id;

        if ($association != null) $newUser->association_id = $association->id;
        if ($club != null) $newUser->club_id = $club->id;

        $arrNewUser = json_decode(json_encode($newUser), true);
        $this->json('PUT', '/users/' . $this->simpleUser->slug, $arrNewUser)
            ->seeInDatabase('users', $arrNewUser);
    }


    /** @test */
    public function it_allow_editing_user_without_password()
    {
        $this->logWithUser($this->root);

        $user = factory(User::class)->create(
            ['name' => 'MyUser',
                'email' => 'MyUser@kendozone.com',
                'role_id' => Config::get('constants.ROLE_USER'),
                'password' => bcrypt('111111'),
                'verified' => 1,]);

        $newUser = factory(User::class)->make();

        $oldPass = $user->password;

        $arrNewData = [
            'name' => $newUser->name,
            'email' => $newUser->email,
            'firstname' => $newUser->firstname,
            'lastname' => $newUser->lastname,
            'role_id' => $newUser->role_id,
        ];

        $this->json('PUT', '/users/' . $user->slug, $arrNewData)
            ->seeInDatabase('users', $arrNewData);

//        // Check that password remains unchanged
        $user = User::where('email', '=', $newUser->email)->first();
        $newPass = $user->password;
        assert($oldPass == $newPass, true);

    }


    /** @test
     */
    public function you_can_change_your_password_and_login_with_new_data()
    {
        $this->logWithUser($this->simpleUser);

        $this->json('PUT', '/users/' . $this->simpleUser->id,
            ['password' => '222222',
                'password_confirmation' => '222222'
            ]);

        //Logout
        Auth::logout();

        $this->json('POST', '/login/', [
            'email', $this->simpleUser->email,
            'password' => '222222']);

        assert(Auth::check(), true);

    }
}
