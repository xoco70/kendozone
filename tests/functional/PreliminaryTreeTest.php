<?php
use App\Championship;
use App\ChampionshipSettings;
use App\Competitor;
use App\Tournament;
use App\Tree;
use App\User;
use App\Venue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;

class PreliminaryTreeTest extends TestCase
{
    use DatabaseTransactions;
//    use WithoutMiddleware;

    protected $root, $tournament, $championship;


    public function setUp()
    {
        parent::setUp();
        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $this->logWithUser($this->root);

        $this->tournament = factory(Tournament::class)->create();
        $this->championship = factory(Championship::class)->create([
            'tournament_id' => $this->tournament->id,
            'category_id' => 1,
        ]);

        factory(ChampionshipSettings::class)->create([
            'championship_id' => $this->championship->id,
            'hasPreliminary' => 1,
            'teamSize' => null,
            'fightingAreas' => 1,
            'preliminaryWinner' => 1,
            'preliminaryGroupSize' => 3,
        ]);

    }

    /** @test */
    public function it_create_a_tree_with_1_competitors()
    {
        $this->unique_test(1, 0);
    }

    /** @test */
    public function it_create_a_tree_with_2_competitors()
    {
        $this->unique_test(2, 1);

    }

    /** @test */
    public function it_create_a_tree_with_3_competitors()
    {
        $this->unique_test(3, 1);
    }

    /** @test */
    public function it_create_a_tree_with_4_competitors()
    {
        $this->unique_test(4, 2);
    }

    /** @test */
    public function it_create_a_tree_with_5_competitors()
    {
        $this->unique_test(5, 2);
    }

    /** @test */
    public function it_create_a_tree_with_6_competitors()
    {

        $this->unique_test(6, 2);

    }

    /** @test */
    public function it_create_a_tree_with_7_competitors()
    {
        $this->unique_test(7, 4); // Should be reparted 2, 2, 2, 1 not 3,3,1,0
    }

    /** @test */
    public function it_create_a_tree_with_8_competitors()
    {
        $this->unique_test(8, 4);
    }

    /** @test */
    public function it_create_a_tree_with_9_competitors()
    {
        $this->unique_test(9, 4);
    }

    /** @test */
    public function it_create_a_tree_with_10_competitors()
    {
        $this->unique_test(10, 4);
    }

    /** @test */
    public function it_create_a_tree_with_11_competitors()
    {
        $this->unique_test(11, 4);
    }

    /** @test */
    public function it_create_a_tree_with_12_competitors()
    {
        $this->unique_test(12, 4);
    }

    /** @test */
    public function it_create_a_tree_with_13_competitors()
    {
        $this->unique_test(13, 8);
    }

    /** @test */
    public function it_create_a_tree_with_14_competitors()
    {
        $this->unique_test(14, 8);
    }

    /** @test */
    public function it_create_a_tree_with_15_competitors()
    {
        $this->unique_test(15, 8);
    }

    /** @test */
    public function it_create_a_tree_with_16_competitors()
    {
        $this->unique_test(16, 8);
    }

    /** @test */
    public function it_create_a_tree_with_17_competitors()
    {
        $this->unique_test(17, 8);
    }

    /** @test */
    public function it_create_a_tree_with_18_competitors()
    {
        $this->unique_test(18, 8);
    }

    /**
     * @param $users
     */
    public function makeCompetitors($users)
    {
        foreach ($users as $user) {
            factory(Competitor::class)->create([
                'user_id' => $user->id,
                'championship_id' => $this->championship->id,
                'confirmed' => 1]);
        }
    }

    public function generatePreliminaryTree()
    {
        $this->visit('/tournaments/' . $this->tournament->slug . "/edit")
            ->click('#competitors')
            ->press('generate');
    }

    public function unique_test($numCompetitors, $numGroupsExpected)
    {
        $users = factory(User::class, $numCompetitors)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        if ($users instanceof User) {
            $user = $users;
            $users = new Collection();
            $users->push($user);
        }
        $this->makeCompetitors($users);
        $this->generatePreliminaryTree();
        $count = Tree::where('championship_id', $this->championship->id)->count();
        $this->assertTrue($count == $numGroupsExpected);
    }


}
