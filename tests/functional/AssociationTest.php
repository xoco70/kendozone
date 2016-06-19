<?php
use App\Association;
use App\Federation;
use App\User;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
    use DatabaseTransactions;


    /** @test
     *
     * superAdmin can do everything
     */
    public function superAdmin_can_see_create_read_update_delete_association()
    {
        $root = User::findOrFail(2);
        $this->logWithUser($root);
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
        $associationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT')]);
        $this->logWithUser($associationPresident);

        $federation = factory(Federation::class)->create();
        $myAssociation = factory(Association::class)->create(['federation_id' => $federation->id, 'president_id' => $associationPresident->id]);


        $this->visit("/")
            ->click($myAssociation->name)
            ->seePageIs("/associations/" . $myAssociation->id . "/edit")
            ->dontSee("403.png");

        $association = factory(Association::class)->make(['federation_id' => $federation->id, 'president_id' => $associationPresident->id]);
        $this->fillAssocAndSee($association);
    }


    // Root, FMK, AIKEM, NAUCALLI --> Assoc

    /** @test
     */
    public function a_federation_president_cannot_edit_an_association_that_doesnt_belongs_to_him(){ // Delete rule is the same, I don't do 2 tests
        $federationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT')]);

        $this->visitEditAssociationPage($federationPresident);
        $this->see("403.png");


    }
    /** @test
     */
    public function a_association_president_cannot_edit_or_delete_an_association_that_doesnt_belongs_to_him(){
        $associationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT')]);
        $this->visitEditAssociationPage($associationPresident);
        $this->see("403.png");
    }
    /** @test
     *
     */
    public function a_club_president_cannot_edit_or_delete_an_association(){
        $clubPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT')]);
        $this->visitEditAssociationPage($clubPresident);
        $this->see("403.png");
    }
    /** @test
     *
     */
    public function only_root_and_fp_can_create_association(){
        $simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $clubPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT')]);
        $associationPresident = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT')]);

        $users = [$associationPresident, $clubPresident, $simpleUser];
        foreach ($users as $user){
            $this->logWithUser($user);
            $this->visitCreateAssociationPage($clubPresident);
            $this->see("403.png");
        }


    }

    /**
     * @param Association $association
     */
    private function fillAssocAndSee(Association $association) //TODO I don't have here to change president
    {

        $this->type($association->name, 'name')
            ->type($association->address, 'address')
            ->type($association->phone, 'phone')
            ->select($association->federation_id, 'federation_id');

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
     * @param User $user
     */
    public function visitEditAssociationPage(User $user)
    {
        $this->logWithUser($user);


        $association = factory(Association::class)->create(['federation_id' => 2, 'president_id' => 2]); // British
        $this->visit('/associations/' . $association->id . '/edit');

    }

    /**
     * @param User $user
     */
    public function visitCreateAssociationPage(User $user)
    {
        $this->logWithUser($user);
        $this->visit('/associations/create');

    }

    /**
     * @param $association
     * @return Association
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
            ->dontSee('403.png');


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
        $this->visit("/associations/".$association->id."/edit");

        $associationData = factory(Association::class)->make(['federation_id' => $association->federation_id]);

        $this->fillAssocAndSee($associationData);

    }

    private function crud()
    {
        $this->canRead(); // R

        $associationData = factory(Association::class)->make(['federation_id' => Auth::user()->federation_id]);
        $this->canCreate($associationData); // C

        // Get Association Full Object

        $association = $this->getFullAssociationObject($associationData);

        $this->canUpdate($association); // C

//        $this->canDelete($association); // C

    }

    /**
     * Create an association with the specified User
     * @param Association $association
     */
    private function canDelete(Association $association)
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
