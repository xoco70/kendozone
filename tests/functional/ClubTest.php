<?php
use App\Association;
use App\Club;
use App\Federation;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Config;

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
class ClubTest extends BrowserKitTest
{
    use DatabaseMigrations;


    /** @test
     *
     * superAdmin can do everything
     */
    public function superAdmin_can_crud_club()
    {
        $root = User::find(2)
            ?? factory(User::class)->create([
                'role_id' => Config::get('constants.ROLE_SUPERADMIN'),
                'email' => 'superuser@kendozone.com'
            ]);

        $this->logWithUser($root);


        $federation = factory(Federation::class)->create(['president_id' => null]);

        $association = factory(Association::class)->create(['president_id' => null]);

        $clubPresident = factory(User::class)->create([
            'role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT'),
            'federation_id' => $federation->id,
            'association_id' => $association->id]);

        $club = factory(Club::class)->make([
            'federation_id' => $federation->id,
            'association_id' => $association->id,
            'president_id' => $clubPresident->id]);

        $this->crud($club);

    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function federationPresident_can_do_everything_in_his_own_federation()
    {
        $fmk = User::where('email', '=', 'fmk@kendozone.com')->first()
            ?? factory(User::class)->create([
                'role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT'),
                'email' => 'fmk@kendozone.com'
            ]);


        $this->logWithUser($fmk);

        $association = factory(Association::class)->create([
            'federation_id' => $fmk->federation->id,
            'president_id' => null
        ]);

        $clubPresident = factory(User::class)->create([
            'role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT'),
            'federation_id' => $fmk->federation->id,
            'association_id' => $association->id]);

        $clubData = factory(Club::class)->make(['federation_id' => $fmk->federation->id, 'association_id' => $association->id, 'president_id' => $clubPresident->id]);
        $this->crud($clubData);
    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function associationPresident_can_do_everything_in_his_own_association()
    {
        $federation = factory(Federation::class)->create(['president_id' => null]);
        $associationPresident = factory(User::class)->create([
            'role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT'),
            'federation_id' => $federation->id]);

        $association = factory(Association::class)->create([
            'federation_id' => $federation->id,
            'president_id' => $associationPresident->id]);
        $associationPresident->association_id = $association->id;
        $associationPresident->save();

        $club = factory(Club::class)->make([
            'federation_id' => $federation->id,
            'association_id' => $association->id,
            'president_id' => $associationPresident->id]);

        $this->logWithUser($associationPresident);

        $this->crud($club);
    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */
    public function a_club_president_can_change_his_club_data() // But not to another club_president
    {
//        $federation = factory(Federation::class)->create(['president_id' => null]);
                $fmk = User::where('email', '=', 'fmk@kendozone.com')->first();
        $federation = $fmk->federation;

        $association = factory(Association::class)->create([
            'federation_id' => $federation->id,
            'president_id' => null]);

        $myClub = factory(Club::class)->create([
            'federation_id' => $federation->id,
            'association_id' => $association->id,
            'president_id' => null,
        ]);

        $clubPresident = factory(User::class)->create([
            'role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT'),
            'federation_id' => $federation->id,
            'association_id' => $association->id,
            'club_id' => $myClub->id]);

        $myClub->president_id = $clubPresident->id;
        $myClub->save();

        $this->logWithUser($clubPresident);

        $club = factory(Club::class)->make([
            'federation_id' => $federation->id,
            'association_id' => $myClub->association_id,
            'president_id' => $clubPresident->id ]);

        $this->visit("/clubs/" . $myClub->id . "/edit")
            ->fillClubAndSee($club);

    }


    // Root, FMK, AIKEM, NAUCALLI --> Assoc

    /** @test
     */
    public function a_federation_president_cannot_edit_a_club_that_doesnt_belongs_to_him()
    { // Delete rule is the same, I don't do 2 tests
        $federationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT')]);

        $this->visitEditClubPage($federationPresident);
        $this->see("403.png");


    }

    /** @test
     */
    public function a_association_president_cannot_edit_or_delete_a_club_that_doesnt_belongs_to_him()
    {
        $associationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT')]);

        $this->visitEditClubPage($associationPresident);
        $this->see("403.png");
    }

    /** @test
     *
     */
    public function a_club_president_cannot_edit_or_delete_a_club()
    {
        $clubPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT')]);
        $this->visitEditClubPage($clubPresident);
//        $this->see("403.png");
    }

    /** @test
     *
     */
//    public function clubPres_and_simple_user_cannot_create_association()
//    {
//        $simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
//        $clubPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT')]);
//
//        $users = [$clubPresident, $simpleUser];
//        foreach ($users as $user) {
//            $this->logWithUser($user);
//            $this->visitCreateClubPage($clubPresident);
//            $this->see("403.png");
//        }
//    }

    /**
     * @param Club $club
     */
    private function fillClubAndSee(Club $club)
    {
        $this->type($club->name, 'name')
            ->type($club->address, 'address')
            ->type($club->phone, 'phone')
            ->select($club->federation_id, 'federation_id')
            ->select($club->association_id, 'association_id')
            ->select($club->president_id, 'president_id');

        $this->press(trans('core.save'));

        $this->seeInDatabase('club',
            ['name' => $club->name,
                'address' => $club->address,
                'phone' => $club->phone,
                'president_id' => $club->president_id,
                'federation_id' => $club->federation_id,
                'association_id' => $club->association_id
            ]);
    }

    private function visit_addClub()
    {
        $this->visit("/clubs")
            ->click('addClub');
    }

    /**
     * @param $club
     * @return mixed
     */
    private function getFullClubObject(Club $club)
    {
        $club = Club::where('name', $club->name)
            ->where('address', $club->address)
            ->where('phone', $club->phone)
            ->first();
        return $club;
    }

    /**
     * @return true if User can create an association
     */
    private function canRead()
    {
        $this->visit("/clubs")
            ->dontSee('403.png');


    }

    public function visitEditClubPage(User $user)
    {
        $this->logWithUser($user);

        $club = factory(Club::class)->create(['president_id' => $user->id]);

        $this->visit('/clubs/' . $club->id . '/edit');

    }

    public function visitCreateClubPage(User $user)
    {
        $this->logWithUser($user);
        $this->visit('/clubs/create');

    }


    /**
     *
     * @param Club $club
     * @return true if User can create an association
     */
    private function canCreate(Club $club)
    {
        $this->visit_addClub();
        $this->fillClubAndSee($club);

    }

    /**
     * Create an association with the specified User
     * @param Club $club
     */
    private function canUpdate(Club $club)
    {
        $this->visit("/clubs/" . $club->id . "/edit");
        $clubData = factory(Club::class)->make([
            'federation_id' => $club->federation_id,
            'association_id' => $club->association_id,
            'president_id' => $club->president_id,
        ]);
        $this->fillClubAndSee($clubData);

    }

    private function crud(Club $clubData)
    {
        $this->canRead(); // R

        $this->canCreate($clubData); // C

//        // Get Club Full Object

//        $club = $this->getFullClubObject($clubData);
//        $this->canUpdate($club); // C

//        $this->canDelete($association); // C

    }

    /** @test */
    public function a_club_president_cant_be_in_2_club()
    {
        $this->expectException(QueryException::class);

        $clubPresident1 = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT')]);

        $club1 = factory(Club::class)->create();
        $club2 = factory(Club::class)->create();

        $club1->president_id = $clubPresident1->id;
        $club2->president_id = $clubPresident1->id;
        $club1->save();
        $club2->save();

    }
}
