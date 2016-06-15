<?php
use App\Federation;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * List of Federation Test
 *
 *  everybody_can_access_federations
 *  it_can_edit_federation
 *  a_federation_president_can_change_his_federation_data
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

        $this->mortalUsers = [$this->simpleUser, $this->clubPresident, $this->associationPresident, $this->federationPresident];

    }


    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function everybody_can_see_federations()
    {
        foreach ($this->mortalUsers as $user) {
            $this->logWithUser($user);

            $this->visit("/")
                ->dontSee('federations');

            $this->visit("/federations")
                ->dontSee('403');
        }

        $this->logWithUser($this->root);
        $this->visit("/");
        $this->click("federations")
             ->dontSee('403');
    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function only_superadmin_can_edit_federation()
    {

        $federation = factory(Federation::class)->create();


        $this->logWithUser($this->root);


        $this->visit("/federations")
            ->click($federation->name)
            ->seePageIs('/federations/' . $federation->id . '/edit')
            ->fillFederationData($federation);

        foreach ($this->mortalUsers as $user) {
            $this->logWithUser($user);
            $this->visit("/federations/".$federation->id."/edit")
                 ->see('403');

        }
    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function a_federation_president_can_change_his_federation_data()
    {
        $this->logWithUser($this->federationPresident);

        $myFederation = factory(Federation::class)->create(['president_id' => $this->federationPresident->id]);
        $hisFederation = factory(Federation::class)->create();

        $this->visit("/federations/" . $hisFederation->id . "/edit")
            ->see('403');
        $this->visit("/")
            ->click($myFederation->name)
            ->seePageIs("/federations/" . $myFederation->id . "/edit")
            ->dontSee('403');
//
        $federationData = factory(Federation::class)->make();
        $this->fillFederationData($federationData);

        $federation = Federation::where('name', $federationData->name)
            ->where('address', $federationData->address)
            ->where('phone', $federationData->phone)
            ->first();

        $users = [$this->simpleUser, $this->clubPresident, $this->associationPresident];
        foreach ($users as $user) {
            $this->logWithUser($user);
            $this->visit("/federations/".$federation->id."/edit");
            $this->see('403');

        }
    }



    private function fillFederationData(Federation $federation) //TODO Country??? President???
    {
        $this->type($federation->name, 'name')
            ->type($federation->address, 'address')
            ->type($federation->phone, 'phone')
            ->press(trans('core.save'))
            ->seeInDatabase('federation',
                ['name' => $federation->name,
                    'address' => $federation->address,
                    'phone' => $federation->phone,
                ]);
    }

}
