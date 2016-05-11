<?php
use App\Association;
use App\Federation;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
class AssociationTest extends TestCase
{
    use DatabaseTransactions;

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
//        $this->clubUsers = [$this->simpleUser, $this->clubPresident];

    }


    /** @test
     *
     * superAdmin can do everything
     */
    public function superAdmin_can_see_create_update_delete_association()
    {
        $this->logWithUser($this->root);
        $association = factory(Association::class)->make();
        $this->crud($this->root, $association);
    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function federationPresident_can_do_everything_but_is_stuck_to_his_federation()
    {
        $this->logWithUser($this->federationPresident);

        $federation = factory(Federation::class)->create(['president_id' => $this->federationPresident->id]);
        factory(Association::class)->create(['federation_id' => $federation->id]); // We create one so that there is
        $association = factory(Association::class)->make(['federation_id' => $federation->id]);

        // When creating an association, Federation must be disabled
        $this->visit("/")
            ->click('associations')
            ->click('addAssociation');

        $this->type($association->name, 'name')
            ->type($association->address, 'address')
            ->type($association->phone, 'phone')
            ->seeElement('select',['name' => 'federation', 'disabled'])
            ->seeElement('input',['name' => 'federation_id', 'type' => 'hidden' ]);
//            ->press(trans('core.save'));
//            ->seePageIs('/associations')
//            ->seeInDatabase('association',
//                ['name' => $association->name,
//                    'address' => $association->address,
//                    'phone' => $association->phone,
//                ]);


    }

    public function crud(User $user,Association $association)
    {


        $this->visit("/")
            ->click('associations')
            ->click('addAssociation');

        $this->fillAssociationData($association);
        $association = Association::where('name', 'MyAssociation')
            ->where('address', 'MyAdress')
            ->where('phone', '55555')
            ->first();
        // Update

        $this->click($association->name);
        $association->name = "MyAssociation2";
        $association->address = "MyAdress2";
        $association->phone = "6666666666";
        $this->fillAssociationData($association);

        // Delete

        $this->press("delete_" . $association->id)
            ->seeIsSoftDeletedInDatabase('association', ['id' => $association->id]);
    }

    private function fillAssociationData(Association $association) //TODO I don't have here to change president
    {
        $this->type($association->name, 'name')
            ->type($association->address, 'address')
            ->type($association->phone, 'phone')
            ->press(trans('core.save'))
            ->seePageIs('/associations')
            ->seeInDatabase('association',
                ['name' => $association->name,
                    'address' => $association->address,
                    'phone' => $association->phone,
                ]);
    }


    /** @test
     *
     * a user must be superAdmin to access federation
     */
    private function changePresident(User $old, User $new)
    {

    }
}
