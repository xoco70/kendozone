<?php
use App\Association;
use App\Federation;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * List of Federation Test
 *
 *  superAdmin_can_see_create_update_delete_association
 *  federationPresident_can_do_everything_but_is_stuck_to_his_federation
 *  a_association_president_can_change_his_association_data
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
    public function federationPresident_can_do_everything_but_is_stuck_to_his_federation()
    {
        $this->logWithUser($this->federationPresident);

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
        $this->fillAssocAndCheck($association);
    }


    /**
     * @param Association $association
     */
    private function fillAssocAndCheck(Association $association) //TODO I don't have here to change president
    {

        $this->type($association->name, 'name')
            ->type($association->address, 'address')
            ->type($association->phone, 'phone');
//            ->select($association->federation->id, 'federation_id');

        $this->press(trans('core.save'))
            ->seeInDatabase('association',
                [   'name' => $association->name,
                    'address' => $association->address,
                    'phone' => $association->phone,
                ]);
    }

    private function visit_addAssociation()
    {
        $this->visit("/")
            ->click('associations')
            ->click('addAssociation')
            ->dump();
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
     * Create an association with the specified User
     */
    private function readAll()
    {
        $this->visit("/associations")
             ->dontSee('403');


    }

    /**
     * Create an association with the specified User
     * @param Association $association
     */
    private function create(Association $association)
    {
        $this->visit_addAssociation();
        $this->fillAssocAndCheck($association);

    }

    /**
     * Create an association with the specified User
     * @param Association $association
     */
    private function update(Association $association)
    {
//        $this->visit("/associations/".$association->id."/edit");
//        $associationData = factory(Association::class)->make();
//        $this->fillAssocAndCheck($associationData);

    }

    public function crud()
    {
        $this->readAll(); // R

        $associationData = factory(Association::class)->make();
        $this->create($associationData); // C

        // Get Association Full Object

        $association = $this->getFullAssociationObject($associationData);

        $this->update($association); // C
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
