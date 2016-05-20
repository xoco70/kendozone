<?php
use App\Club;
use App\Federation;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * List of Federation Test
 *
 *  only_superAdmin_can_access_clubs
 *  it_can_edit_club
 *
 * User: juliatzin
 * Date: 10/11/2015
 * Time: 23:14
 */
class ClubTest extends TestCase
{
    use DatabaseTransactions;

    protected $user, $users, $root, $simpleUser, $clubPresident, $associationPresident; // $addUser,  $editUser,
    protected $mortalUsers, $stateUsers, $clubUsers;

    public function setUp()
    {
        parent::setUp();
        $this->simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $this->clubPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT')]);
        $this->associationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT')]);
        $this->clubPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT')]);
        $this->root = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_SUPERADMIN')]);

//        $this->mortalUsers = [$this->simpleUser, $this->clubPresident, $this->associationPresident, $this->clubPresident];
        $this->stateUsers = [$this->simpleUser, $this->clubPresident, $this->associationPresident];
//        $this->clubUsers = [$this->simpleUser, $this->clubPresident];

    }


    /** @test
     *
     * superAdmin can do everything
     */
    public function superAdmin_can_see_create_update_delete_club()
    {
        $this->logWithUser($this->root);

        $this->crud($this->root);
    }

    /** @test
     *
     * a user must be superAdmin to access club
     */
    public function clubPresident_can_do_everything_but_is_stuck_to_his_club()
    {
        $this->logWithUser($this->clubPresident);

//        $myFederation = factory(Federation::class)->create(['president_id' => $this->clubPresident->id]);
//        $hisFederation = factory(Federation::class)->create(['president_id' => 3]);
//
//
//        // SEE FP Can see only his assoc
//        $myAssoc = factory(Club::class)->create(['club_id' => $myFederation->id]); // We create one so that there is
//        $notMyAssoc = factory(Club::class)->create(['club_id' => $hisFederation->id]); // We create one so that there is
//
//        $this->visit("/")
//            ->click('clubs')
//            ->see($myAssoc->name)
//            ->dontSee($notMyAssoc->name);
//
//        $this->crud($this->clubPresident);
    }

    /** @test
     *
     * a user must be superAdmin to access club
     */
    public function a_club_president_can_change_his_club_data()
    {
//        $this->logWithUser($this->clubPresident);
//
//        $myClub = factory(Club::class)->create(['president_id' => $this->clubPresident->id]);
//
//
//        $this->visit("/")
//            ->click($myClub->name)
//            ->seePageIs("/clubs/" . $myClub->id . "/edit");
//
//        $club = factory(Club::class)->make();
//        $this->fillClubData($this->clubPresident, $club);
    }


    /**
     * @param User $user
     */
    public function crud(User $user)
    {
//        $this->visit_addClub();
//        $club = factory(Club::class)->make();
//
//        $this->fillClubData($user, $club);
//        $club = $this->getFullClubObject($club);
//        // Update
//
//        $this->click($club->name);
//        $club->name = "MyClub2";
//        $club->address = "MyAdress2";
//        $club->phone = "6666666666";
//        $this->fillClubData($user, $club);
//
//        // Delete
//
//        $this->press("delete_" . $club->id)
//            ->seeIsSoftDeletedInDatabase('club', ['id' => $club->id]);
    }

    /**
     * @param User $user
     * @param Club $club
     */
    private function fillClubData(User $user, Club $club) //TODO I don't have here to change president
    {
//        $this->type($club->name, 'name')
//            ->type($club->address, 'address')
//            ->type($club->phone, 'phone');
//
//        if ($user->isClubPresident()) {
//            $this->seeElement('input', ['name' => 'club', 'disabled' => 'disabled'])
//                ->seeElement('input', ['name' => 'club_id', 'type' => 'hidden']);
//        }
//
//        $this->press(trans('core.save'))
//            ->seePageIs('/clubs')
//            ->seeInDatabase('club',
//                ['name' => $club->name,
//                    'address' => $club->address,
//                    'phone' => $club->phone,
//                ]);
    }

    private function visit_addClub()
    {
//        $this->visit("/")
//            ->click('clubs')
//            ->click('addClub');
    }

    /**
     * @param $club
     * @return mixed
     */
    private function getFullClubObject($club)
    {
//        $club = Club::where('name', $club->name)
//            ->where('address', $club->address)
//            ->where('phone', $club->phone)
//            ->first();
//        return $club;
    }


//    /** @test
//     *
//     * a user must be superAdmin to access club
//     */
//    public function changePresident(User $old, User $new)
//    {
//
//    }
}
