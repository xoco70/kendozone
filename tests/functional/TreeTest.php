<?php
use App\Championship;
use App\ChampionshipSettings;
use App\Competitor;
use App\Tournament;
use App\User;
use App\Venue;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TreeTest extends TestCase
{
    use DatabaseTransactions;
//    use WithoutMiddleware;

    protected $root;


    public function setUp()
    {
        parent::setUp();
//        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
//        $this->logWithUser($this->root);
    }

    /** @test */
    public function it_create_a_tree_with_2_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_3_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_4_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_5_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_6_competitors()
    {
        // Having
        $tournament = factory(Tournament::class)->create();
        $championsip = factory(Championship::class)->create(['tournament_id' => $tournament->id]);

        $users = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')],6);
        $competitors = new Collection();
        foreach ($users as $user){
            $competitor = factory(User::class)->create([
                'user_id' => $user->id,
                'championship_id',
                $championsip->id,
                'confirmed' => 1]);
            $competitors->push($competitor);
        }
        $this->visit('/tournaments/'.$tournament->slug."/edit")
            ->click('competitors')
            ->click('generate');
        // Check there is 2 rows with 3 users



    }
    /** @test */
    public function it_create_a_tree_with_7_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_8_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_9_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_10_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_11_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_12_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_13_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_14_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_15_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_16_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_17_competitors()
    {

    }
    /** @test */
    public function it_create_a_tree_with_18_competitors()
    {

    }



}
