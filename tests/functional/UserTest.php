<?php

use App\Association;
use App\Championship;
use App\Club;
use App\Competitor;
use App\Federation;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Xoco70\LaravelTournaments\Models\ChampionshipSettings;


class UserTest extends BrowserKitTest
{
    use DatabaseMigrations;

    protected $user, $users, $root, $simpleUser;

    public function setUp()
    {
        parent::setUp();
        $this->simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
    }

// Root fonctionnality, doesn't work for now
// I have to figure out how to create avatar without user
//    /** @test */
//    public function it_denies_creating_an_empty_user()
//    {
//        $this->logWithUser($this->root);
//
//        $this->visit("/users/create")
//            ->press(trans('core.save'))
//            ->seePageIs('/users/create')
//            ->see(trans('validation.required', ['attribute' => "name"]))
//            ->see(trans('validation.required', ['attribute' => "E-mail"]))
//            ->see(trans('validation.required', ['attribute' => "password"]));
//
//    }

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

        $this->json('POST', '/users/create', $user->toArray());

        $this->notSeeInDatabase('users', ['name' => 'MyUser']);

    }


//    /** @test */
//    public function it_delete_user() // Should be restored ASAP
//    {
//        $this->logWithUser($this->root);
//        // Given
//
//        $tournament = factory(Tournament::class)->create(['user_id' => $this->simpleUser->id, 'level_id' => 1]);
//        $championship1 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
//        factory(ChampionshipSettings::class)->create(['championship_id' => $championship1->id]);
//        factory(Competitor::class)->create(['championship_id' => $championship1->id]);
//
//        $response = $this->actingAs($this->root, 'api')->json('DELETE', '/users/' . $this->simpleUser->slug);
//        $response->assertResponseStatus(200);
//
//        $this->seeIsSoftDeletedInDatabase('users', ['name' => $this->simpleUser->name])
//            ->seeIsSoftDeletedInDatabase('tournament', ['user_id' => $this->simpleUser->id])
//            ->seeIsSoftDeletedInDatabase('championship', ['id' => $championship1->id])
//            ->seeIsSoftDeletedInDatabase('championship_settings', ['championship_id' => $championship1->id])
//            ->seeIsSoftDeletedInDatabase('competitor', ['championship_id' => $championship1->id]);
//    }


    /** @test */
    public function you_must_be_the_user_to_edit_your_info_or_be_superuser()
    {
        // fill role table
        Artisan::call('db:seed', ['--class' => 'RoleSeeder', '--database' => 'sqlite']);

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
        Artisan::call('db:seed', ['--class' => 'RoleSeeder', '--database' => 'sqlite']);
        Artisan::call('db:seed', ['--class' => 'GradeSeeder', '--database' => 'sqlite']);
        Artisan::call('db:seed', ['--class' => 'CountriesSeeder', '--database' => 'sqlite']);
        $user2 = factory(User::class)->create(['name' => 'AnotherUser']);
        $this->logWithUser($this->simpleUser);
        $this->visit('/users/' . $this->simpleUser->slug)
            ->dontSee("403.png")
            ->visit('/users/' . $user2->slug . '/edit')
            ->see("403");
    }


    /** @test */
    public function create_user()
    {
        Mail::fake();
        $this->logWithUser($this->root);
        Artisan::call('db:seed', ['--class' => 'RoleSeeder', '--database' => 'sqlite']);
        Artisan::call('db:seed', ['--class' => 'CountriesSeeder', '--database' => 'sqlite']);

        $user = factory(User::class)->make(['role_id' => Config::get('constants.ROLE_USER')]);

        $this->json('POST', '/users', $user->toArray())
            ->seeInDatabase('users', $user->toArray());

    }


    /** @test */
    public function edit_user()
    {

        $this->logWithUser($this->simpleUser);
        Artisan::call('db:seed', ['--class' => 'RoleSeeder', '--database' => 'sqlite']);
        Artisan::call('db:seed', ['--class' => 'CountriesSeeder', '--database' => 'sqlite']);

        $newUser = factory(User::class)->make(['role_id' => Config::get('constants.ROLE_USER')]);


        $this->json('PUT', '/users/' . $this->simpleUser->slug, $newUser->toArray())
            ->seeInDatabase('users', $newUser->toArray());
    }


    /** @test */
    public function it_changes_user_club()
    {
        Artisan::call('db:seed', ['--class' => 'RoleSeeder', '--database' => 'sqlite']);
        Artisan::call('db:seed', ['--class' => 'CountriesSeeder', '--database' => 'sqlite']);

        $this->logWithUser($this->simpleUser);
        $newUser = factory(User::class)->make(['role_id' => Config::get('constants.ROLE_USER')]);

        $federation = factory(Federation::class)->create();
        $association = factory(Association::class)->create(['federation_id' => $federation->id]);
        $club = factory(Club::class)->create(['association_id' => $association->id]);

//        if ($association != null) $club = Club::inRandomOrder()->where('association_id', $association->id)->first();

        $newUser->federation_id = $federation->id;

        if ($association != null) $newUser->association_id = $association->id;
        if ($club != null) $newUser->club_id = $club->id;

        $this->json('PUT', '/users/' . $this->simpleUser->slug, $newUser->toArray())
            ->seeInDatabase('users', $newUser->toArray());
    }


    /** @test */
    public function it_allow_editing_user_without_password()
    {
        $this->logWithUser($this->root);
        Artisan::call('db:seed', ['--class' => 'RoleSeeder', '--database' => 'sqlite']);
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
        $this->assertTrue($oldPass == $newPass);

    }


    /** @test
     */
    public function you_can_change_your_password_and_login_with_new_data()
    {
        $this->logWithUser($this->simpleUser);

        $this->json('PUT', '/users/' . $this->simpleUser->slug,
            ['name' => $this->simpleUser->name,
                'email' => $this->simpleUser->email,
                'password' => '222222',
                'password_confirmation' => '222222'
            ]);


        //Logout
        Auth::logout();

        $this->json('POST', '/login', [
            'email' => $this->simpleUser->email,
            'password' => '222222']);

        $this->assertTrue(Auth::check());
    }


}
