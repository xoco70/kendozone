<?php

use App\CategoryTournament;
use App\CategoryTournamentUser;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class DashboardTest extends TestCase
{
    /**
     * Tests inside:
     * an_admin_may_invite_users_but_users_must_register_after
     * a_user_may_register_an_open_tournament -  FAILING WHEN USING FB
     */

    use DatabaseTransactions;

    protected $user, $users, $addUser, $editUser, $root, $simpleUser;

    public function setUp()
    {
        parent::setUp();

        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $this->simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

        $this->user = trans_choice('core.user', 1);
        $this->users = trans_choice('core.user', 2);
        $this->addUser = Lang::get('core.addModel', ['currentModelName' => $this->user]);
        $this->editUser = Lang::get('core.updateModel', ['currentModelName' => $this->user]);
    }

    /** @test */
    public function dashboard_check_initial_state()
    {
//        $users = [$this->root, $this->simpleUser];
//        shuffle($users);
//
//        $randUser = $users[0];

        // Given
        Auth::loginUsingId($this->simpleUser->id);

        // Nothing has been created, default dash
        $this->visit('/')
            ->see(trans('core.welcome_text'))
            ->see(trans('core.create_new_tournament'))
            ->dontSee(trans('core.congigure_categories'));


        // Create 1 tournament
        Auth::loginUsingId($this->simpleUser->id);

        $tournament0 = factory(Tournament::class)->create(['name' => 't1', 'user_id' => $this->simpleUser->id]);

        $this->visit('/')
            ->seeInElement("del.text-muted", trans('core.create_new_tournament'));

        Auth::loginUsingId($this->simpleUser->id);

        // Now configure 2/2 categories

        $cts = factory(CategoryTournament::class,2)->create(['tournament_id' => $tournament0->id])
            ->each(function ($u) {
                $u->settings()->save(factory(App\CategorySettings::class)->make());
            });;

        $this->visit('/')
             ->seeInElement("del.text-muted", trans('core.congigure_categories'));

        // Now add ctu

        factory(CategoryTournamentUser::class)->create(['category_tournament_id' => $cts->first()->id]);

        $this->visit('/')
            ->see(trans('core.tournaments_created'))
            ->see(trans('core.tournaments_registered'));
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
