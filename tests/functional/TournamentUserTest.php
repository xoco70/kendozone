<?php
use App\CategoryTournament;
use App\Tournament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

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
    use DatabaseTransactions;

//    protected $tournament, $tournaments, $addTournament, $addTournaments, $editTournament;


    public function setUp()
    {
        parent::setUp();
        Auth::loginUsingId(1);
    }

    /** @test */
    public function it_add_a_user_to_tournament_category(){

    }

    /** @test */
    public function it_removes_a_user_from_tournament_category(){

    }

    /** @test */
    public function you_must_own_tournament_to_add_or_remove_user_from_tournament(){

    }

}
