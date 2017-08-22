<?php

use App\Championship;
use App\Competitor;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Xoco70\KendoTournaments\Models\ChampionshipSettings;

class DashboardTest extends BrowserKitTest
{
    /**
     * Tests inside:
     * an_admin_may_invite_users_but_users_must_register_after
     * a_user_may_register_an_open_tournament -  FAILING WHEN USING FB
     */

    use DatabaseMigrations;

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
        Artisan::call('db:seed', ['--class' => 'CountriesSeeder', '--database' => 'sqlite']);
        Artisan::call('db:seed', ['--class' => 'TournamentLevelSeeder', '--database' => 'sqlite']);
        Artisan::call('db:seed', ['--class' => 'CategorySeeder', '--database' => 'sqlite']);
        // Given
        $this->logWithUser($this->simpleUser);

        // Nothing has been created, default dash
        $this->visit('/')
            ->see(trans('core.create_new_tournament'))
            ->dontSee(trans('core.congigure_categories'));


        // Create 1 tournament
        $tournament0 = factory(Tournament::class)->create(['user_id' => $this->simpleUser->id]);

        $this->visit('/')
            ->seeInElement("p.text-muted", trans('core.no_tournament_created_yet'));

        // Now configure 2/2 categories

//        $championship1 = factory(Championship::class)->create(['tournament_id' => $tournament0->id,'category_id'=>1]);
//        $championship2 = factory(Championship::class)->create(['tournament_id' => $tournament0->id,'category_id'=>2]);
//
//        factory(ChampionshipSettings::class)->create(['championship_id' => $championship1->id]);
//        factory(ChampionshipSettings::class)->create(['championship_id' => $championship2->id]);
//
//        $this->visit('/')
//            ->seeInElement("span.text-muted", trans('core.congigure_categories'));
//
//        // Now add ctu
//
//        factory(Competitor::class)->create(['championship_id' => $championship1->id]);
//
//        $this->visit('/')
//            ->see(trans('core.tournaments_created'));
//            ->see(trans('core.tournaments_registered'));
    }

//    /** @test */
//    public function dashboard_check_tournament_created_widget()
//    {
//        // Given
//
//    }
//
//    /** @test */
//    public function dashboard_check_tournament_registered_widget()
//    {
//        // Given
//
//    }
}
