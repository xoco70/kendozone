<?php
use App\ChampionshipSettings;
use App\Championship;
use App\Competitor;
use App\Tournament;
use App\User;
use App\Venue;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
class ChampionshipTest extends TestCase
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
    public function it_create_custom_championship(){
//        category/create
        $category = factory(\App\Category::class)->make();
        $arrCat1 = json_decode(json_encode($category), true);

        $response = $this->json('POST', '/api/v1/category/create', $arrCat1);
        unset($arrCat1['name']); // Remove category name that is translated and make test fail
        $this->seeInDatabase('category', $arrCat1);
    }

    /** @test */
    public function it_create_championship_settings()
    {
        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => Auth::user()->id]);

        $ct0 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
        $cs0 = factory(ChampionshipSettings::class)->make();
        $arrCs0 = json_decode(json_encode($cs0), true);


        //TODO Endpoint should be /championships/{id}/settings

        $this->json('POST', '/tournaments/' . $tournament->slug . '/categories/' . $ct0->category_id . '/settings', $arrCs0)
            ->seeInDatabase('championship_settings', $arrCs0);
    }

    /** @test */
    public function it_edit_championship_settings()
    {
        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => Auth::user()->id]);

        $ct0 = factory(Championship::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
        $cs0 = factory(ChampionshipSettings::class)->create();
        $cs1 = factory(ChampionshipSettings::class)->make();
        $arrCs1 = json_decode(json_encode($cs1), true);


        //TODO Endpoint should be /championships/{id}/settings

        $this->json('PUT', '/tournaments/' . $tournament->slug . '/categories/' . $ct0->category_id . '/settings/'.$cs0->id, $arrCs1)
            ->seeInDatabase('championship_settings', $arrCs1);

    }



}
