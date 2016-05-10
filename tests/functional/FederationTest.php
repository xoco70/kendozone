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

//        $this->mortalUsers = [$this->simpleUser, $this->clubPresident, $this->associationPresident, $this->federationPresident];
        $this->stateUsers = [$this->simpleUser, $this->clubPresident, $this->associationPresident];
//        $this->clubUsers = [$this->simpleUser, $this->clubPresident];

    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function only_superAdmin_can_access_federations()
    {
        foreach ($this->stateUsers as $user) {
            $this->logWithUser($user);
            $this->visit("/federations")
                ->see('403');
        }
        $this->logWithUser($this->root);
        $this->visit("/federations")
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
