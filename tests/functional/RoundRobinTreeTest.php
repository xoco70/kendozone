<?php
use App\Championship;
use Xoco70\KendoTournaments\Models\ChampionshipSettings;
use App\Competitor;
use App\Fight;
use App\Tournament;
use App\Round;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;

class RoundRobinTreeTest extends TestCase
{
    use DatabaseTransactions;

    protected $root, $tournament, $championship;


    public function setUp()
    {
        parent::setUp();
        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $this->logWithUser($this->root);

    }

    /** @test */
    public function check_number_of_row_when_generating_roundRobin()
    {
        $numCompetitors =    [1, 2, 3, 4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14];
        $numFightsExpected = [0, 1, 3, 6, 10, 15, 21, 28, 36, 45, 55, 66, 78, 91];
        $numAreas = [1];

        foreach ($numAreas as $numArea) {
            foreach ($numCompetitors as $numCompetitor) {
                $tournament = factory(Tournament::class)->create([
                    'user_id' => $this->root->id // julien@t4b.mx
                ]);

                $championship = factory(Championship::class)->create([
                    'tournament_id' => $tournament->id,
                    'category_id' => 1,
                ]);

                factory(ChampionshipSettings::class)->create([
                    'championship_id' => $championship->id,
                    'hasPreliminary' => 0,
                    'treeType' => 0, // Round Robin
                    'teamSize' => null,
                    'fightingAreas' => $numArea,
                ]);


                $users = factory(User::class, $numCompetitor,$numCompetitors)->create(['role_id' => Config::get('constants.ROLE_USER')]);
                if ($users instanceof User) {
                    $user = $users;
                    $users = new Collection();
                    $users->push($user);
                }
                $this->makeCompetitors($championship, $users);

                $this->generatePreliminaryTree($tournament);

                for ($area = 1; $area <= $numArea; $area++){
                    $rounds = Round::where('championship_id', $championship->id)
                                    ->where('area', $area)->first();
                    if ($rounds == null){
                        $count = 0;
                    }else{
                        $count = Fight::where('round_id', $rounds->id)
                            ->where('area', $area)
                            ->count();

                    }

                    if ((int ) ($numCompetitor / $numArea) <= 1) {
                        $this->assertTrue($count == 0);
                    } else {
                        $expected = (int)($numFightsExpected[$numCompetitor - 1] / $numArea);

                        if ($count != $expected) {
                            dd(["Type" => "RoundRobin"],
                                ["NumCompetitors" => $numCompetitor],
                                ["NumArea" => $numArea],
                                ["Real" => $count],
                                ["Excepted" => $expected],
                                ["numGroupsExpected[".($numCompetitor - 1)."]" => $numFightsExpected[$numCompetitor - 1]." / ".  $numArea]);
                        }
                        $this->assertTrue($count == $expected);
                    }
                }

            }
        }

    }


    /**
     * @param $users
     */
    public function makeCompetitors($championship, $users)
    {
        foreach ($users as $user) {
            factory(Competitor::class)->create([
                'user_id' => $user->id,
                'championship_id' => $championship->id,
                'confirmed' => 1]);
        }
    }

    public function generatePreliminaryTree(Tournament $tournament)
    {
        $this->visit('/tournaments/' . $tournament->slug . "/edit")
            ->click('#competitors')
            ->press('generate');
    }
}
