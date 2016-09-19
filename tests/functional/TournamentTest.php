<?php
use App\Championship;
use App\ChampionshipSettings;
use App\Competitor;
use App\Tournament;
use App\User;
use App\Venue;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

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
            ->seePageIs('/login');
    }

    /** @test */
    public function it_create_tournament_manually()
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
        $categories = DB::table("championship")->where("tournament_id", '=', $tournament->id)->get();
        foreach ($categories as $item) {
            $this->assertContains($item->category_id, $categoriesAdded);

        }
    }

    /** @test */
    public function it_create_tournament_with_rules()
    {
        $this->visit('/')
            ->click(trans('core.createTournament'))
            ->type('MyTournament', 'name')
            ->type('2015-12-12', 'dateIni')
            ->type('2015-12-12', 'dateFin')
            ->select(1, 'rule_id')
            ->press(trans('core.addModel', ['currentModelName' => trans_choice('core.tournament', 1)]))
            ->seeInDatabase('tournament', ['name' => 'MyTournament']);

        $categoriesAdded = array_keys(config('options.ikf_settings'));
        // See categories is added
        $tournament = Tournament::where("name", "MyTournament")->first();
        $championships = Championship::where("tournament_id", '=', $tournament->id)->get();
        foreach ($championships as $championship) {
            $this->assertContains($championship->category_id, $categoriesAdded);
            //TODO We could check the content of the setting
            $this->seeInDatabase('championship_settings',
                ['championship_id' => $championship->id,
                ]);

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
        $tournament = $tournament ?? factory(Tournament::class)->create(['name' => 'MyTournament']);

        $this->visit('/tournaments/' . $tournament->slug . '/edit')
            ->type('MyTournamentXXX', 'name')
            ->type('2015-12-15', 'dateIni')
            ->type('2015-12-15', 'dateFin')
            ->type('2015-12-16', 'registerDateLimit')
            ->type('1', 'type')
            ->type('2', 'level_id')
            ->press('saveTournament')
            ->seeInDatabase('tournament',
                ['name' => 'MyTournamentXXX',
                    'dateIni' => '2015-12-15',
                    'dateFin' => '2015-12-15',
                    'registerDateLimit' => '2015-12-16',
                    'type' => '1',
                    'level_id' => '2',
                ]);
    }


    /** @test */
    public function you_must_own_tournament_or_be_superuser_to_edit_it()
    {
        $root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $user = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $otherUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $this->logWithUser($root);

        $myTournament = factory(Tournament::class)->create(['user_id' => $root->id]);

        //add categories

        factory(Championship::class)->create(['tournament_id' => $myTournament->id]);

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
        $ct1 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
        $ct2 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 2]);
        factory(ChampionshipSettings::class)->create(['championship_id' => $ct1->id]);
        factory(Competitor::class)->create(['championship_id' => $ct1->id]);

        // Check that tournament is gone
        $this->visit("/tournaments")
            ->see(trans_choice('core.tournament', 2))
            ->press("delete_" . $tournament->slug)
            ->seeIsSoftDeletedInDatabase('tournament', ['id' => $tournament->id])
            ->seeIsSoftDeletedInDatabase('championship', ['id' => $ct1->id])
            ->seeIsSoftDeletedInDatabase('championship', ['id' => $ct2->id]);
//            ->seeIsSoftDeletedInDatabase('category_settings', ['championship_id' => $ct1->id])
//            ->seeIsSoftDeletedInDatabase('competitor', ['championship_id' => $ct1->id]);

    }

    /** @test */
    public function it_restore_tournament()
    {
        $tournament = factory(Tournament::class)->create([
            'user_id' => Auth::user()->id,
            'deleted_at' => '2015-12-12']);

        $this->json('POST', '/api/v1/tournaments/' . $tournament->slug . '/restore')
            ->seeInDatabase('tournament', [
                'id' => $tournament->id,
                'deleted_at' => null
            ]);
    }

    public function setTournamentRules(Tournament $tournament, $ruleId)
    {


    }

    /** @test */
    public function update_general_info_in_tournament()
    {

        $tournament = factory(Tournament::class)->create();
        $newTournament = factory(Tournament::class)->make(['user_id' => $tournament->user_id]);
        $arrNewTournament = json_decode(json_encode($newTournament), true);

        $this->json('PUT', '/tournaments/' . $tournament->slug, $arrNewTournament)
            ->seeInDatabase('tournament', $arrNewTournament);
    }

    /** @test */
    public function update_venue_info_in_tournament()
    {
        $tournament = factory(Tournament::class)->create();
        $venue = factory(Venue::class)->make();
        $arrVenue = json_decode(json_encode($venue), true);
        $this->json('PUT', '/tournaments/' . $tournament->slug, $arrVenue)
            ->seeInDatabase('venue', $arrVenue);
    }


    /** @test
     */
    public function user_can_see_tournament_info_but_cannot_edit_it()
    {
        $owner = factory(User::class)->create(['name' => 'AnotherUser']);
        $simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => $owner->id]);

        $this->logWithUser($simpleUser);

        $this->visit('/tournaments/' . $tournament->slug)
            ->dontSee("403")
            ->visit('/tournaments/' . $tournament->slug . '/edit')
            ->see("403");
    }


}
