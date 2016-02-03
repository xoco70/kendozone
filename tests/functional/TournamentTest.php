<?php
use App\CategorySettings;
use App\CategoryTournament;
use App\Tournament;
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

    protected $tournament, $tournaments, $addTournament, $addTournaments, $editTournament;


    public function setUp()
    {
        parent::setUp();
        $this->tournament = trans_choice('crud.tournament', 1);
        $this->tournaments = trans_choice('crud.tournament', 2);
        $this->addTournament = Lang::get('crud.addModel', ['currentModelName' => $this->tournament]);
        $this->addTournaments = Lang::get('crud.addModel', ['currentModelName' => $this->tournaments]);

        $this->editTournament = Lang::get('crud.updateModel', ['currentModelName' => $this->tournament]);

        Auth::loginUsingId(1);
    }

    /** @test */
    public function it_denies_creating_an_empty_tournament()
    {
//        $nameMandatory = Lang::get('validation.filled', ['attribute' => "name"]);
//        echo $nameMandatory;
//        assertEquals($nameMandatory , "El campo name es obligatorio");
//        Auth::loginUsingId(1);

        $this->visit("/tournaments")
            ->see($this->tournaments)
            ->click($this->addTournaments)
            ->press($this->addTournament)
            ->seePageIs('/tournaments/create')
            ->see("El campo name es obligatorio")//Lang::get('validation.filled', ['attribute' => "name"])
            ->see("El campo date es obligatorio")//Lang::get('validation.filled', ['attribute' => "tournament"])
            ->see("El campo category es obligatorio")//Lang::get('validation.filled', ['attribute' => "category"])

            ->notSeeInDatabase('tournament', ['name' => '']);

    }

    /** @test */
    public function it_denies_editing_an_invalid_tournament()
    {

        $tournament = factory(Tournament::class)->create();

        $this->visit('/tournaments/' . $tournament->id . '/edit')
            ->see($this->tournaments)
            ->type('1111', 'name')
            ->press(Lang::get('core.save'))
            ->see("El campo name debe contener al menos 6 caracteres.")//Lang::get('validation.filled', ['attribute' => "category"])
            ->notSeeInDatabase('tournament',
                ['name' => '1111',
                ]);
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
            ->click($this->tournaments)
            ->see($this->tournaments)
            ->click($this->addTournaments)
            ->type('MyTournament', 'name')
            ->type('2015-12-12', 'date')
            ->storeInput('category', [1, 2], true)
            ->press($this->addTournament)
            ->see(Lang::get('core.operation_successful'))
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

    /** @test */
    public function it_edit_tournament($tournament = null)
    {
        if ($tournament == null){
            $tournament = factory(Tournament::class)->create(['name' => 'MyTournament']);
            factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id]);

        }

        $this->visit('/tournaments/' . $tournament->id . '/edit')
            ->see($this->tournaments)
            ->type('MyTournament', 'name')
            ->type('2015-12-15', 'date')
            ->type('2015-12-16', 'registerDateLimit')
            ->type('1', 'mustPay')
            ->type('1', 'type')
//            ->type('5000', 'cost')
            ->type('2', 'level_id')
            ->type('CDOM', 'venue')
            ->type('1.11111', 'latitude')
            ->type('2.22222', 'longitude')
            ->press(trans("core.save"))
            ->dontSee("403")
            ->see(htmlentities(Lang::get('core.operation_successful')))
            ->seeInDatabase('tournament',
                ['name' => 'MyTournament',
                    'date' => '2015-12-15',
                    'registerDateLimit' => '2015-12-16',
                    'mustPay' => '1',
                    'type' => '1',
//                    'cost' => '5000',
                    'level_id' => '2',
                    'venue' => 'CDOM',
                    'latitude' => '1.11111',
                    'longitude' => '2.22222',
                ]);
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

        $this->visit('/tournaments/' . $tournament->id . '/edit')
//            ->type('1', 'isTeam0')
//            ->type('1', 'hasEncho0')
//            ->type('1', 'hasRoundRobin0')
//            ->type('1', 'hasHantei0')
            ->type('100', 'cost')
            ->type('1', 'roundRobinWinner')
//            ->type('1', 'fightDuration0')
//            ->type('1', 'enchoDuration0')
//            ->type('2', 'teamSize0')
//            ->type('2', 'enchoQty0')
//            ->type('2', 'fightingAreas0')
            ->press('save0')
            ->see(htmlentities(Lang::get('core.operation_successful')))
            ->seeInDatabase('category_settings',
                ['category_tournament_id' => $ct0->id,
                    'cost' => '100',
                    'roundRobinWinner' => '1',
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

        $setting0 = factory(CategorySettings::class)->create([
            'category_tournament_id' => $ct0->id,
            'roundRobinWinner' => 2,
            'cost' => 100,
        ]);

        $this->visit('/tournaments/' . $tournament->id . '/edit')
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
            ->see(htmlentities(Lang::get('core.operation_successful')))
            ->seeInDatabase('category_settings',
                ['category_tournament_id' => $ct0->id,
                    'cost' => '200',
                    'roundRobinWinner' => '1',
                ]);
//
//        ;


    }
    /** @test */
    public function you_must_own_tournament_to_edit_it_or_be_superuser()
    {

        $myTournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => Auth::user()->id]);

        //add categories

        factory(CategoryTournament::class)->create(['tournament_id' => $myTournament->id]);

        $this->it_edit_tournament($myTournament); // it must be OK because tournament is mine
        $hisTournament = factory(Tournament::class)->create(['name' => 't2', 'user_id' => 3]);
        // 1 is SuperUser so it should be OK
        $this->visit('/tournaments/' . $hisTournament->id . '/edit')
            ->see($this->tournaments);
        Auth::loginUsingId(2);
        $this->visit('/tournaments/' . $hisTournament->id . '/edit')
            ->see("403");
        Auth::loginUsingId(1);

    }

    /** @test */
    public function it_delete_tournament(){

    }
}
