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

        $this->crud($this->root);
    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function federationPresident_can_do_everything_but_is_stuck_to_his_federation()
    {
        $this->logWithUser($this->federationPresident);

        $myFederation = factory(Federation::class)->create(['president_id' => $this->federationPresident->id]);
        $hisFederation = factory(Federation::class)->create(['president_id' => 3]);


        // SEE FP Can see only his assoc
        $myAssoc = factory(Association::class)->create(['federation_id' => $myFederation->id]); // We create one so that there is
        $notMyAssoc = factory(Association::class)->create(['federation_id' => $hisFederation->id]); // We create one so that there is

        $this->visit("/")
            ->click('associations')
            ->see($myAssoc->name)
            ->dontSee($notMyAssoc->name);

        $this->crud($this->federationPresident);
    }


    /**
     * @param User $user
     */
    public function crud(User $user)
    {
        $this->visit_addAssociation();
        $association = factory(Association::class)->make();

        $this->fillAssociationData($user, $association);
        $association = $this->getFullAssociationObject($association);
        // Update

        $this->click($association->name);
        $association->name = "MyAssociation2";
        $association->address = "MyAdress2";
        $association->phone = "6666666666";
        $this->fillAssociationData($user, $association);

        // Delete

        $this->press("delete_" . $association->id)
            ->seeIsSoftDeletedInDatabase('association', ['id' => $association->id]);
    }

    /**
     * @param User $user
     * @param Association $association
     */
    private function fillAssociationData(User $user, Association $association) //TODO I don't have here to change president
    {
        $this->type($association->name, 'name')
            ->type($association->address, 'address')
            ->type($association->phone, 'phone');

        if ($user->isFederationPresident()) {
            $this->seeElement('input', ['name' => 'federation', 'disabled' => 'disabled'])
                ->seeElement('input', ['name' => 'federation_id', 'type' => 'hidden']);
        }

        $this->press(trans('core.save'))
            ->seePageIs('/associations')
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


//    /** @test
//     *
//     * a user must be superAdmin to access federation
//     */
//    public function changePresident(User $old, User $new)
//    {
//
//    }
}
