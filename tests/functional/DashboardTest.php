<?php

use App\CategoryTournament;
use App\Invite;
use App\Tournament;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class DashboardTest extends TestCase
{
    /**
     * Tests inside:
     * an_admin_may_invite_users_but_users_must_register_after
     * a_user_may_register_an_open_tournament -  FAILING WHEN USING FB 
     */

    use DatabaseTransactions;

//    public function setUp()
//    {
//        parent::setUp();
//        Auth::loginUsingId(1);
//    }

    /** @test */
    public function dashboard_check_initial_state()
    {
        // Given

    }
    /** @test */
    public function dashboard_check_tournament_created_widget()
    {
        // Given

    }

    /** @test */
    public function dashboard_check_tournament_registered_widget()
    {
        // Given

    }
}
