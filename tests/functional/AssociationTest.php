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

//        $this->mortalUsers = [$this->simpleUser, $this->clubPresident, $this->associationPresident, $this->federationPresident];
        $this->stateUsers = [$this->simpleUser, $this->clubPresident, $this->associationPresident];
//        $this->clubUsers = [$this->simpleUser, $this->clubPresident];

    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function superAdmin_can_see_create_update_delete_association()
    {
        // Create


        // Update
        $association = factory(Association::class)->create();

        $this->logWithUser($this->root);
        $this->visit("/")
            ->click('associations')
            ->type('MyAssociation', 'name')
            ->type('MyAdress', 'address')
            ->type('5555555555', 'phone')
            ->press(trans('core.save'))
            ->seePageIs('/associations')
            ->seeInDatabase('association',
                ['id' => $association->id,
                    'name' => 'MyAssociation',
                    'address' => 'MyAdress',
                    'phone' => '5555555555',

                ]);


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
            ->type('MyFederation', 'name')
            ->type('MyAdress', 'address')
            ->type('5555555555', 'phone')
            ->press(trans('core.save'))
            ->seePageIs('/federations')
            ->seeInDatabase('federation',
                ['id' => $federation->id,
                    'name' => 'MyFederation',
                    'address' => 'MyAdress',
                    'phone' => '5555555555',

                ]);
    }

}
