<?php
use App\Championship;
use App\Competitor;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

/**
 * List of User Test
 *
 * it_add_a_user_to_tournament_category()
 * it_removes_a_user_from_tournament_category()
 * you_must_own_tournament_or_be_superuser_to_add_or_remove_user_from_tournament
 * you_can_confirm_a_user
 *
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
class CompetitorTest extends BrowserKitTest
{
    use DatabaseMigrations;

    protected $user, $users, $addUser, $editUser, $root, $simpleUser;


    public function setUp()
    {
        parent::setUp();
        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);

        $this->logWithUser($this->root);
    }

    /** @test */
    public function it_add_a_user_to_championship()
    {
        $tournament = factory(Tournament::class)->create(['user_id' => $this->root->id]);
        $championship = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);

        $existingUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $deletedUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER'), 'deleted_at' => "2015-01-01"]);

        $newUser = clone $existingUser;
        $newUser->email = "new@email.com";

        $usersToAdd = [ $existingUser, $deletedUser]; //


        foreach ($usersToAdd as $user) {
            $this->addCompetitorToChampionship($championship, $user);
        }
        // It sends a mail...

    }

    public function addCompetitorToAllChampionship($tournament, $user)
    {
        foreach ($tournament->championships as $championship) {
            $this->addCompetitorToChampionship($championship, $user);

        }
    }

    public function addCompetitorToChampionship($championship, $user)
    {
        $tournament = $championship->tournament;
        $firstnames[] = $user->firstname;
        $lastnames[] = $user->lastname;
        $emails[] = $user->email;
        $this->actingAs($this->root, 'api')
            ->post('/tournaments/' . $tournament->slug . '/users/',
                ['firstnames' => $firstnames,
                    'lastnames' => $lastnames,
                    'emails' => $emails,
                    'championshipId' => $championship->id]);

        $myUser = User::where('email', $user->email)->firstOrFail();


        $this->seeInDatabase('competitor',
            ['championship_id' => $championship->id,
                'user_id' => $myUser->id,
            ]);
    }

    /** @test */
    public function it_removes_a_user_or_a_team_from_tournament_category()
    {
        // Given
        $tournament = factory(Tournament::class)->create(['user_id' => Auth::user()->id]);
        $championship1 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]); // Single
//        $championship2 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 2]); // Team

        $user = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
//        $team = factory(Team::class)->create();

        factory(\App\Competitor::class)->create(['championship_id' => $championship1->id, 'user_id' => $user->id]);
//        factory(\App\Competitor::class)->create(['championship_id' => $championship2->id, 'user_id' => $team->id]);

        $this->visit("/tournaments/$tournament->slug/users")
            // delete_t1111_73_prof-jaquelin-bruen
            ->press("delete_" . $tournament->slug . "_" . $championship1->id . "_" . $user->slug)// delete_olive_21_xoco70athotmail
            ->notSeeInDatabase('competitor', ['championship_id' => $championship1->id, 'user_id' => $user->id]);

//        $this->visit("/tournaments/$tournament->slug/users")
//            // delete_t1111_73_prof-jaquelin-bruen
//            ->press("delete_" . "_" . $team->id)// delete_olive_21_xoco70athotmail
//            ->notSeeInDatabase('competitor', ['championship_id' => $championship2->id, 'user_id' => $user->id]);

    }

    /** @test */
    public function you_must_own_tournament_or_be_superuser_to_add_or_remove_user_from_tournament()
    {
        $root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $owner = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
//        $simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

        $user = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

        $tournament = factory(Tournament::class)->create(['user_id' => $owner->id]);
        $championship1 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
//        $championship2 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 2]);
//        $ct3 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 3]);

//        foreach ($users as $user) {

        // Attach user to 2 categories
        factory(\App\Competitor::class)->create(['championship_id' => $championship1->id, 'user_id' => $user->id]);
//        factory(\App\Competitor::class)->create(['championship_id' => $championship2->id, 'user_id' => $user->id]);
//        factory(\App\Competitor::class)->create(['championship_id' => $ct3->id, 'user_id' => $user->id]);


        $this->logWithUser($root);
        // delete first user as root
        $this->visit("/tournaments/$tournament->slug/users")
            ->press("delete_" . $tournament->slug . "_" . $championship1->id . "_" . $user->slug)// delete_olive_21_xoco70athotmail
            ->notSeeInDatabase('competitor', ['championship_id' => $championship1->id, 'user_id' => $user->id]);


//            // delete user in category2 as owner
//        $this->logWithUser($owner);
//        $this->visit("/tournaments/$tournament->slug/users")
//            ->press("delete_" . $tournament->slug . "_" . $championship2->id . "_" . $user->slug)
//            ->notSeeInDatabase('competitor', ['championship_id' => $championship2->id, 'user_id' => $user->id]);

//            // can't delete first user as owner
//        $this->logWithUser($simpleUser);
//            // delete first user as owner
//        $this->visit("/tournaments/$tournament->slug/users")
//            ->dontSee("delete_" . $tournament->slug . "_" . $ct3->id . "_" . $user->slug)
//            ->seeInDatabase('competitor', ['championship_id' => $ct3->id, 'user_id' => $user->id]);

//        }


    }

    /** @test */
    public function you_must_own_tournament_or_be_superuser_to_confirm_a_user_in_a_category()
    {
        $root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $owner = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

        $user = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

        $tournament = factory(Tournament::class)->create(['user_id' => $owner->id]);
        $championship1 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);


        // Attach user to category
        factory(\App\Competitor::class)->create(['championship_id' => $championship1->id, 'user_id' => $user->id, 'confirmed' => 0]);

        $this->logWithUser($root);
        // delete first user as root
        $this->visit("/tournaments/$tournament->slug/users")
            ->press("confirm_" . $tournament->slug . "_" . $championship1->id . "_" . $user->slug)// confirm_fake-tournoi_2_admin
            ->seeInDatabase('competitor', ['championship_id' => $championship1->id, 'user_id' => $user->id, 'confirmed' => 1]);

        $this->visit("/tournaments/$tournament->slug/users")
            ->press("confirm_" . $tournament->slug . "_" . $championship1->id . "_" . $user->slug)// confirm_fake-tournoi_2_admin
            ->seeInDatabase('competitor', ['championship_id' => $championship1->id, 'user_id' => $user->id, 'confirmed' => 0]);

        $this->logWithUser($owner);

        $this->visit("/tournaments/$tournament->slug/users")
            ->press("confirm_" . $tournament->slug . "_" . $championship1->id . "_" . $user->slug)// confirm_fake-tournoi_2_admin
            ->seeInDatabase('competitor', ['championship_id' => $championship1->id, 'user_id' => $user->id, 'confirmed' => 1]);

        $this->logWithUser($simpleUser);

        $this->visit("/tournaments/$tournament->slug/users")
            ->dontSee("confirm_" . $tournament->slug . "_" . $championship1->id . "_" . $user->slug)// confirm_fake-tournoi_2_admin
            ->seeInDatabase('competitor', ['championship_id' => $championship1->id, 'user_id' => $user->id, 'confirmed' => 1]);

    }

    /** @test */
    public function a_competitor_always_has_the_same_short_id_in_a_tournament()
    {
        $tournament = factory(Tournament::class)->create(['user_id' => $this->root->id]);
        $championship1 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 3]); // Single
        $championship2 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 4]); // Single
        $this->addCompetitorToChampionship($championship1, $this->root);
        $this->addCompetitorToChampionship($championship2, $this->root);


        $competitor1 = Competitor::where('championship_id', $championship1->id)
            ->where('user_id', $this->root->id)->select('short_id')->first();


        $competitor2 = Competitor::where('championship_id', $championship2->id)
            ->where('user_id', $this->root->id)->select('short_id')->first();


        $this->assertEquals($competitor1->short_id, $competitor2->short_id);

    }
}
