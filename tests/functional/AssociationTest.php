<?php
use App\Association;
use App\User;
use Illuminate\Contracts\Validation\UnauthorizedException;

/**
 * List of Association Test
 *
 *  superAdmin_can_see_create_update_delete_association
 *  federationPresident_can_do_everything_in_his_own_federation
 *  a_association_president_can_change_his_association_data
 *  check_denied_access_to_create_association
 *  check_denied_access_to_edit_association
 *
 *
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
class AssociationTest extends TestCase
{
//    use DatabaseTransactions;

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

//        $this->mortalUsers = [$this->simpleUser, $this->clubPresident, $this->associationPresident, $this->federationPresident];
        $this->stateUsers = [$this->simpleUser, $this->clubPresident, $this->associationPresident];

    }


    /** @test
     *
     * superAdmin can do everything
     * @expectedException Exception
     */
    public function test_exception()
    {
//        \PHPUnit_Framework_TestCase::setExpectedException(UnauthorizedException::class);

        $this->logWithUser($this->simpleUser);
        $this->visit("/associations/1/edit");

    }
    /** @test
     *
     * superAdmin can do everything
     */
    public function superAdmin_can_see_create_read_update_delete_association()
    {
        $this->logWithUser($this->root);
        $this->crud();

    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function federationPresident_can_do_everything_in_his_own_federation()
    {
        $fmk = User::where('email', '=', 'fmk@kendozone.com')->first();
        $this->logWithUser($fmk);

        $this->crud();
    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function a_association_president_can_change_his_association_data()
    {
        $this->logWithUser($this->associationPresident);

        $myAssociation = factory(Association::class)->create(['president_id' => $this->associationPresident->id]);


        $this->visit("/")
            ->click($myAssociation->name)
            ->seePageIs("/associations/" . $myAssociation->id . "/edit")
            ->dontSee(403);

        $association = factory(Association::class)->make();
        $this->fillAssocAndSee($association);
    }


    // Root, FMK, AIKEM, NAUCALLI --> Assoc

    /** @test
     *
     */
    public function a_federation_president_cant_edit_or_delete_an_association_that_doesnt_belongs_to_him(){

    }


    /**
     * @param Association $association
     */
    private function fillAssocAndSee(Association $association) //TODO I don't have here to change president
    {

        $this->type($association->name, 'name')
            ->type($association->address, 'address')
            ->type($association->phone, 'phone');
//            ->select($association->federation->id, 'federation_id');

        $this->press(trans('core.save'))
            ->seeInDatabase('association',
                ['name' => $association->name,
                    'address' => $association->address,
                    'phone' => $association->phone,
                ]);
    }

    private function visit_addAssociation()
    {
        $this->visit("/")
            ->click('associations')
            ->click('addAssociation');
    }

    /**
     * @param $association
     * @return mixed
     */
    private function getFullAssociationObject($association)
    {
        $association = Association::where('name', $association->name)
            ->where('address', $association->address)
            ->where('phone', $association->phone)
            ->first();
        return $association;
    }

    /**
     * @return true if User can create an association
     */
    private function canRead()
    {
        $this->visit("/associations")
            ->dontSee('403');


    }

    /**
     *
     */
    private function cannotRead()
    {
        $this->visit("/associations");


    }

    /**
     * @return true if User cannot create an association
     * @param Association $association
     * @
     */
    private function cannotCreate(Association $association)
    {
        $this->visit_addAssociation();
        $this->fillAssocAndSee($association);

    }

    /**
     * @return true if User can create an association
     * @param Association $association
     */
    private function canCreate(Association $association)
    {
        $this->visit_addAssociation();
        $this->fillAssocAndSee($association);

    }
    /**
     * Create an association with the specified User
     * @param Association $association
     */
    private function canUpdate(Association $association)
    {
//        $this->visit("/associations/".$association->id."/edit");
//        $associationData = factory(Association::class)->make();
//        $this->fillAssocAndCheck($associationData);

    }

    private function crud()
    {
        $this->canRead(); // R

        $associationData = factory(Association::class)->make();
        $this->canCreate($associationData); // C

        // Get Association Full Object

        $association = $this->getFullAssociationObject($associationData);

        $this->canUpdate($association); // C
    }

    /**
     * Create an association with the specified User
     * @param Association $association
     */
    private function delet(Association $association)
    {
        // Don't include it because of pagination
//        $this->press("delete_" . $association->id)
//            ->seeIsSoftDeletedInDatabase('association', ['id' => $association->id]);

    }

//
//    /** @test
//     *
//     * a user must be superAdmin to access federation
//     */
//    public function changePresident(User $old, User $new)
//    {
//
//    }
}
