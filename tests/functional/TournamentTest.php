<?php
use App\CategorySettings;
use App\CategoryTournament;
use App\CategoryTournamentUser;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

/**
 * List of User Test
 *
 * it_denies_creating_an_empty_tournament()
 * mustBeAuthenticated()
 * it_create_tournament($delete = true)
 * it_edit_tournament()
 * you_must_own_tournament_to_edit_it_or_be_superuser()
 * it_configure_a_tournament_category
 * it_delete_tournament
 *
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
class TournamentTest extends TestCase
{
    use DatabaseTransactions;
//    use WithoutMiddleware;

    protected $root;


    public function setUp()
    {
        parent::setUp();
        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $this->logWithUser($this->root);
    }

    /** @test */
    public function it_denies_creating_an_empty_tournament()
    {
        $this->visit("/tournaments")
            ->click(trans('core.createTournament'))
            ->press(trans('core.addModel', ['currentModelName' => trans_choice('core.tournament', 1)]))
            ->seePageIs('/tournaments/create')
            ->see(trans('validation.filled', ['attribute' => "name"]))
//            ->see(trans('validation.filled', ['attribute' => "dateIni"])) // It's inserting spaces
//            ->see(trans('validation.filled', ['attribute' => "dateFin"]))
            ->see(trans('validation.filled', ['attribute' => "category"]))

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
    public function it_create_tournament()
    {
        $this->visit('/')
            ->click(trans('core.createTournament'))
            ->type('MyTournament', 'name')
            ->type('2015-12-12', 'dateIni')
            ->type('2015-12-12', 'dateFin')
            ->storeInput('category', [1, 2], true)
            ->press(trans('core.addModel', ['currentModelName' => trans_choice('core.tournament', 1)]))
//            ->see(trans('msg.tournament_create_successful', ['name' => 'MyTournament']))
            ->seeInDatabase('tournament', ['name' => 'MyTournament']);

        $categoriesAdded = [1, 2];
        // See categories is added
        $tournament = Tournament::where("name", "MyTournament")->first();
        $categories = DB::table("category_tournament")->where("tournament_id", '=', $tournament->id)->get();
        foreach ($categories as $item) {
            $this->assertContains($item->category_id, $categoriesAdded);

        }

    }

    public function storeInput($element, $text, $force = false)
    {
        if ($force) {
            $this->inputs[$element] = $text;
            return $this;
        } else {
            return parent::storeInput($element, $text);
        }
    }

    /** @test
     * @param null $tournament
     */
    public function it_edit_tournament($tournament = null)
    {
        if ($tournament == null) {
            $tournament = factory(Tournament::class)->create(['name' => 'MyTournament']);
            factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id]);

        }

        $this->visit('/tournaments/' . $tournament->slug . '/edit')
            ->type('MyTournamentXXX', 'name')
//            ->type('2015-12-15', 'dateIni')
//            ->type('2015-12-15', 'dateFin')
//            ->type('2015-12-16', 'registerDateLimit')
//            ->type('1', 'type')
//            ->type('2', 'level_id')
//            ->type('CDOM', 'venue')
//            ->type('1.11111', 'latitude')
//            ->type('2.22222', 'longitude')
            ->press('saveTournament')
            ->seeInDatabase('tournament',
                ['name' => 'MyTournamentXXX',
//                    'dateIni' => '2015-12-15',
//                    'dateFin' => '2015-12-15',
//                    'registerDateLimit' => '2015-12-16',
//                    'type' => '1',
//                    'level_id' => '2',
//                    'venue' => 'CDOM',
//                    'latitude' => '1.11111',
//                    'longitude' => '2.22222',
                ]);
//        $t = Tournament::where('name','MyTournamentXXX')->first();
//        dd($t);
    }


    /** @test */
    public function it_create_tournament_category_conf()
    {
        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => Auth::user()->id]);

        $ct0 = factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
        factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 2]);
        factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 3]);
        factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 4]);
        factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 5]);

        $this->visit('/tournaments/' . $tournament->slug . '/edit')
//            ->type('1', 'isTeam0')
//            ->type('1', 'hasEncho0')
//            ->type('1', 'hasRoundRobin0')
//            ->type('1', 'hasHantei0')
            ->type('100', 'cost')
//            ->type('1', 'roundRobinWinner')
//            ->type('1', 'fightDuration0')
//            ->type('1', 'enchoDuration0')
//            ->type('2', 'teamSize0')
//            ->type('2', 'enchoQty0')
//            ->type('2', 'fightingAreas0')
            ->press('save0')
//            ->see(htmlentities(trans('core.operation_successful')))
            ->seeInDatabase('category_settings',
                ['category_tournament_id' => $ct0->id,
                    'cost' => '100',
//                    'roundRobinWinner' => '1',
                ]);
//
//        ;


    }

    /** @test */
    public function it_edit_tournament_category_conf()
    {
        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => Auth::user()->id]);

        $ct0 = factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
        factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 2]);
        factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 3]);
        factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 4]);
        factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 5]);

        factory(CategorySettings::class)->create([
            'category_tournament_id' => $ct0->id,
            'hasRoundRobin' => 1,
            'roundRobinWinner' => 2,
            'cost' => 100,
        ]);

        $this->visit('/tournaments/' . $tournament->slug . '/edit')
//            ->type('1', 'isTeam0')
//            ->type('1', 'hasEncho0')
//            ->type('1', 'hasRoundRobin0')
//            ->type('1', 'hasHantei0')
            ->type('200', 'cost')
            ->type('1', 'roundRobinWinner')
//            ->type('1', 'fightDuration0')
//            ->type('1', 'enchoDuration0')
//            ->type('2', 'teamSize0')
//            ->type('2', 'enchoQty0')
//            ->type('2', 'fightingAreas0')
            ->press('save0')
//            ->see(htmlentities(trans('core.operation_successful')))
            ->seeInDatabase('category_settings',
                ['category_tournament_id' => $ct0->id,
                    'cost' => '200',
                    'roundRobinWinner' => '1',
                ]);
//
//        ;


    }

    /** @test */
    public function you_must_own_tournament_or_be_superuser_to_edit_it()
    {
        $root =  factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $user =  factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $otherUser =  factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $this->logWithUser($root);

        $myTournament = factory(Tournament::class)->create(['user_id' => $root->id ]);

        //add categories

        factory(CategoryTournament::class)->create(['tournament_id' => $myTournament->id]);

        $this->it_edit_tournament($myTournament); // it must be OK because tournament is mine
        $hisTournament = factory(Tournament::class)->create(['user_id' => $user->id]);
        // 1 is SuperUser so it should be OK
        $this->visit('/tournaments/' . $hisTournament->slug . '/edit')
            ->see(trans_choice('core.tournament', 2));
        $this->logWithUser($otherUser);
        $this->visit('/tournaments/' . $hisTournament->slug . '/edit')
            ->see("403");
    }

    /** @test */
    public function it_delete_tournament()
    {

        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => Auth::user()->id]);
        $ct1 = factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
        $ct2 = factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 2]);
        factory(CategorySettings::class)->create(['category_tournament_id' => $ct1->id]);
        factory(CategoryTournamentUser::class)->create(['category_tournament_id' => $ct1->id]);

        // Check that tournament is gone
        $this->visit("/tournaments")
            ->see(trans_choice('core.tournament', 2))
            ->press("delete_" . $tournament->slug)
            ->seeIsSoftDeletedInDatabase('tournament',['id' => $tournament->id])
            ->seeIsSoftDeletedInDatabase('category_tournament',['id' => $ct1->id])
            ->seeIsSoftDeletedInDatabase('category_tournament',['id' => $ct2->id]);
//            ->seeIsSoftDeletedInDatabase('category_settings', ['category_tournament_id' => $ct1->id])
//            ->seeIsSoftDeletedInDatabase('category_tournament_user', ['category_tournament_id' => $ct1->id]);

    }
}
