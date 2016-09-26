<?php
use App\Federation;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;

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


    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function everybody_can_see_federations()
    {

        $simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $clubPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT')]);
        $associationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT')]);
        $federationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT')]);
        $root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);

        $mortalUsers = [$simpleUser, $clubPresident, $associationPresident, $federationPresident];

        foreach ($mortalUsers as $user) {
            $this->logWithUser($user);

            $this->visit("/")
                ->dontSee('federations');

            $this->visit("/federations")
                ->dontSee('403.png');
        }

        $this->logWithUser($root);
        $this->visit("/");
    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function only_superadmin_can_edit_federation()
    {
        $simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $clubPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT')]);
        $associationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT')]);
        $federationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT')]);
        $root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);
        $mortalUsers = [$simpleUser, $clubPresident, $associationPresident, $federationPresident];

        $federation = Federation::find(2);


        $this->logWithUser($root);


        $this->visit("/federations")
            ->click($federation->name)
            ->seePageIs('/federations/' . $federation->id . '/edit')
            ->fillFederationData($federation);

        foreach ($mortalUsers as $user) {
            $this->logWithUser($user);
            $this->visit("/federations/".$federation->id."/edit")
                 ->see('403.png');

        }
    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function a_federation_president_can_change_his_federation_data()
    {
        $simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $clubPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT')]);
        $associationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT')]);
        $federationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT')]);

        $this->logWithUser($federationPresident);

        $myFederation = factory(Federation::class)->create(['president_id' => $federationPresident->id]);
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

        $users = [$simpleUser, $clubPresident, $associationPresident];
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

    /** @test
     */
    public function a_federation_president_cant_be_in_2_federations()
    {
        $this->expectException(QueryException::class);

        $federationPresident1 = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT')]);

        $federation1 = factory(Federation::class)->create();
        $federation2 = factory(Federation::class)->create();

        $federation1->president_id = $federationPresident1->id;
        $federation2->president_id = $federationPresident1->id;
        $federation1->save();
        $federation2->save();

    }
}
