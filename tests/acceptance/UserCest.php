<?php

use App\Association;
use App\Club;
use App\Federation;
use App\Grade;
use App\User;
use Faker\Factory as Faker;
use Step\Acceptance\SimpleUser;
use Step\Acceptance\SuperAdmin;

class UserCest
{
    protected $user, $grades, $countries;

    protected function _inject()
    {
        $this->user = factory(User::class)->make();;
        $this->grades = Grade::all()->pluck('id')->toArray();
        $this->countries = Countries::all()->pluck('id')->toArray();

    }

    // test
    public function it_create_user(\AcceptanceTester $I, $scenario)
    {
        App::setLocale('es');

        $I = new SimpleUser($scenario);
        $I->logAsUser();
        $I->dontSee(trans_choice('core.user', 2) . ' </a></li>');
        $I->logout();
        $I = new SuperAdmin($scenario);
        $I->logAsSuperAdmin();

        $I->click('#dropdown-user');
        $I->click('#users');
        $I->click('#adduser');
        $I->fillField('name', $this->user->name);
        $I->fillField('email', $this->user->email);
        $I->fillField('firstname', $this->user->firstname);
        $I->fillField('lastname', $this->user->lastname);
        $I->fillField('password', '111111');
        $I->fillField('password_confirmation', '111111');


        $faker = Faker::create();
        $gradeId = $faker->randomElement($this->grades);
        $countryId = $faker->randomElement($this->countries);

        $I->selectOption('form select[name=grade_id]', $gradeId);

        $federation = Federation::where('name', 'Mexican Kendo Federation')->first();
        $association = Association::where('name', 'Asociación Mexiquense de Kendo, A.C.')->first();
        $club = Club::where('name', 'Naucali')->first();

        $I->selectOption('form select[name=country_id]', $countryId);
        $I->wait(1);
        $I->click('#federation_id');
        $I->selectOption('form select[name=federation_id]', $federation->name);
        $I->wait(2);
        $I->selectOption('form select[name=association_id]', $association->name);
        $I->wait(2);
        $I->selectOption('form select[name=club_id]', $club->name);
//
//        $I->attachFile('input[type="file"]',  'avatar2.png'); // TODO Aqui podria simular Dropzone de verdad
        $I->click("#save1");

        $I->seeInDatabase('ken_users',
            ['name' => $this->user->name,
                'email' => $this->user->email,
                'firstname' => $this->user->firstname,
                'lastname' => $this->user->lastname,
//                'grade_id' => $gradeId,
//                'country_id' => $countryId,
                'federation_id' => $federation->id,
                'association_id' => $association->id,
                'club_id' => $club->id,
            ]);

        $this->user->delete();


    }

    // test
    public function it_edit_user(\AcceptanceTester $I, $scenario)
    {
        App::setLocale('es');
        $this->user = factory(User::class)->make();
        $I->haveInDatabase('user', $this->user);
        $I = new SimpleUser($scenario);
        $I->logAsUser();

        $I->dontSee(trans_choice('core.user', 2) . ' </a></li>');
        $I->logout();
        $I = new SuperAdmin($scenario);
        $I->logAsSuperAdmin();

        $I->amOnPage('/users/' . $this->user->slug . '/edit/');
//        $I->makeScreenshot('edit');
        $federation = Federation::where('name', 'Mexican Kendo Federation')->first();
        $association = Association::where('name', 'Asociación de Iaido y Kendo del Instituto Politécnico Nacional')->first();
        $club = Club::where('association_id', $association->id)->first();

        $I->fillField('name', "juju2");
        $I->fillField('firstname', 'may');
        $I->fillField('lastname', 'orozco');
        $I->fillField('password', '222222');
        $I->fillField('password_confirmation', '222222');
        $faker = Faker::create();
        $gradeId = $faker->randomElement($this->grades);
        $countryId = $faker->randomElement($this->countries);
        $I->selectOption('form select[name=grade_id]', $gradeId);
        $I->selectOption('form select[name=country_id]', $countryId);

        // Seed those test so they always pass
        $I->wait(1);
        $I->click('#federation_id');
        $I->wait(2);
        $I->selectOption('form select[name=federation_id]', $federation->name);
        if ($association != null) {
            $I->wait(2);
            $I->selectOption('form select[name=association_id]', $association->name);
            $I->wait(3);
        }
        if ($club != null) {
            $I->selectOption('form select[name=club_id]', $club->name);

        }

        $I->click("#save1");
//        $I->seeInSource(trans('msg.user_update_successful'));
        $I->seeInDatabase('ken_users',
            ['name' => "juju2",
                'firstname' => "may",
                'lastname' => "orozco",
                'grade_id' => $gradeId,
                'country_id' => $countryId,
                'federation_id' => $federation->id,
                'association_id' => $association->id,
                'club_id' => $club->id,
            ]);


        $this->user->delete();


    }

    // test
    public function you_can_change_your_password_and_login_with_new_data(\AcceptanceTester $I, $scenario)
    {
        $this->user = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
        $I = new SuperAdmin($scenario);
        $I->logAsSuperAdmin();
        $I->amOnPage("/users/" . $this->user->slug . "/edit/");
        $I->fillField('password', '333333');
        $I->fillField('password_confirmation', '333333');
        $I->click("#save1");
//        $I->seeInSource(trans('msg.user_update_successful'));
//
//        //Logout
        $I->logout();
//        // Login Again with new Data

        $I->amOnPage('/');
        $I->fillField('email', $this->user->email);
        $I->fillField('password', '333333');
        $I->click("#login");
        $I->seeCurrentUrlEquals('/');
        $this->user->delete();

    }

}

?>