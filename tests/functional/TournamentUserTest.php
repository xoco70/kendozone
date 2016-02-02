<?php
use App\Tournament;
use App\User;
use Illuminate\Support\Facades\Auth;

/**
 * List of User Test
 *
 * it_add_a_user_to_tournament_category()
 * it_removes_a_user_from_tournament_category()
 * you_must_own_tournament_to_add_or_remove_user_from_tournament()
 *
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
class TournamentUserTest extends TestCase
{
//    use DatabaseTransactions;

//    protected $tournament, $tournaments, $addTournament, $addTournaments, $editTournament;


    public function setUp()
    {
        parent::setUp();
        Auth::loginUsingId(1);
    }

    /** @test */
    public function it_add_a_user_to_tournament_category()
    {
        // Given

        $tournament = Tournament::find(1);


        $categoryTournaments = $tournament->categoryTournaments;
        foreach ($categoryTournaments as $categoryTournament) {
            echo $categoryTournament->category->name;
            $this->visit('/tournaments/' . $tournament->id . '/edit')
                ->click(trans_choice('crud.competitor', 2))
                ->click('addcompetitor' . $categoryTournament->id)
                ->type('usertest', 'username')
                ->type('usertest@gmail.com', 'email')
                ->press(trans("core.save"))
                ->seePageIs('/tournaments/' . $tournament->id . '/users');


            $user = User::where('email', 'usertest@gmail.com')->first();
            // User must exists
            $this->seeInDatabase('category_tournament_user',
                ['category_tournament_id' => $categoryTournament->id,
                    'user_id' => $user->id,
                ]);
        }


    }

    /** @test */
    public function it_removes_a_user_from_tournament_category()
    {

    }

    /** @test */
    public function you_must_own_tournament_to_add_or_remove_user_from_tournament()
    {

    }

}
