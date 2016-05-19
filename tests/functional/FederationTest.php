<?php
use App\CategorySettings;
use App\CategoryTournament;
use App\CategoryTournamentUser;
use App\Federation;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

/**
 * List of Federation Test
 *
 *  only_superAdmin_can_access_federations
 *  it_can_edit_federation
 *
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
class FederationTest extends TestCase
{
    use DatabaseTransactions;
//    use WithoutMiddleware;


    protected $user, $users, $root, $simpleUser, $clubPresident, $associationPresident, $federationPresident; // $addUser,  $editUser,
    protected $mortalUsers, $stateUsers, $clubUsers;

    public function setUp()
    {
        parent::setUp();
        $this->simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $this->clubPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT')]);
        $this->associationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT')]);
        $this->federationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT')]);
        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);

        $this->stateUsers = [$this->simpleUser, $this->clubPresident, $this->associationPresident];

    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function only_superAdmin_can_access_federations()
    {
        foreach ($this->stateUsers as $user) {
            $this->logWithUser($user);
            $this->visit("/")
                ->dontSee('federations');
            $this->visit("/federations")
                ->see('403');
        }
        $this->logWithUser($this->root);
        $this->visit("/")
            ->click("federations")
            ->dontSee('403');

    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function it_can_edit_federation()
    {

        $federation = factory(Federation::class)->create();


        $this->logWithUser($this->root);



        $this->visit("/federations")
            ->click($federation->name)
            ->seePageIs('/federations/' . $federation->id . '/edit')
            ->fillFederationData($federation);

    }



    private function fillFederationData(Federation $federation) //TODO Country??? President???
    {
        $this->type($federation->name, 'name')
            ->type($federation->address, 'address')
            ->type($federation->phone, 'phone')
            ->press(trans('core.save'))
            ->seePageIs('/federations')
            ->seeInDatabase('federation',
                ['name' => $federation->name,
                    'address' => $federation->address,
                    'phone' => $federation->phone,
                ]);
    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function a_federation_president_can_change_his_federation_data()
    {
        $this->logWithUser($this->federationPresident);

        $myFederation = factory(Federation::class)->create(['president_id' => $this->federationPresident->id]);


        $this->visit("/")
            ->click($myFederation->name)
            ->seePageIs("/federations/" . $myFederation->id . "/edit")
            ->dontSee(403);

        $federation = factory(Federation::class)->make();
        $this->fillFederationData($federation);
    }

}
