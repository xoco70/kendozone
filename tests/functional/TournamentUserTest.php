<?php
use App\CategoryTournament;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

/**
 * List of User Test
 *
 * it_add_a_user_to_tournament_category()
 * it_removes_a_user_from_tournament_category()
 * you_must_own_tournament_to_add_or_remove_user_from_tournament()
 * you_can_confirm_a_user
 *
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
class TournamentUserTest extends TestCase
{
    use DatabaseTransactions;

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
        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => Auth::user()->id]);
        factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
        factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 2]);


        $categoryTournaments = $tournament->categoryTournaments;
//        dd($categoryTournaments);
        foreach ($categoryTournaments as $categoryTournament) {
//            echo $categoryTournament->category->name;
            $this->visit('/tournaments/' . $tournament->slug . '/edit')
                ->click(trans_choice('crud.competitor', 2))
//                ->dump();
                ->click('addcompetitor' . $categoryTournament->id)
                ->type('usertest', 'username')
                ->type('usertest@gmail.com', 'email')
                ->press(trans("core.save"))
                ->seePageIs('/tournaments/' . $tournament->slug . '/users');


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
        // Given
        $tournament = factory(Tournament::class)->create(['name' => 't1', 'user_id' => Auth::user()->id]);
        $ct1 = factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 1]);
        $ct2 = factory(CategoryTournament::class)->create(['tournament_id' => $tournament->id, 'category_id' => 2]);

        $users = factory(User::class, 3)->create(['role_id' => 3]);

        foreach ($users as $user){
            factory(\App\CategoryTournamentUser::class)->create(['category_tournament_id' => $ct1->id, 'user_id' => $user->id]);
            factory(\App\CategoryTournamentUser::class)->create(['category_tournament_id' => $ct2->id, 'user_id' => $user->id]);

            $this->visit("/tournaments/$tournament->slug/users")
                // delete_t1111_73_prof-jaquelin-bruen
                ->press("delete_" . $tournament->slug."_".$ct1->id."_".$user->slug)   // delete_olive_21_xoco70athotmail
                ->seeIsSoftDeletedInDatabase('category_tournament_user', ['category_tournament_id' => $ct1->id, 'user_id' => $user->id]);

            $this->visit("/tournaments/$tournament->slug/users")
                // delete_t1111_73_prof-jaquelin-bruen
                ->press("delete_" . $tournament->slug."_".$ct2->id."_".$user->slug)   // delete_olive_21_xoco70athotmail
                ->seeIsSoftDeletedInDatabase('category_tournament_user', ['category_tournament_id' => $ct2->id, 'user_id' => $user->id]);
        }
    }

    /** @test */
    public function you_must_own_tournament_to_add_or_remove_user_from_tournament()
    {

    }

    /** @test */
    public function you_can_confirm_a_user()
    {

    }



}
