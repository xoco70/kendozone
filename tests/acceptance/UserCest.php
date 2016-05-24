<?php

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
        App::setLocale('en');

        $I = new SimpleUser($scenario);
        $I->logAsUser();
        $I->dontSee(trans_choice('core.user', 2) . ' </a></li>');
        $I->logout();
        $I = new SuperAdmin($scenario);
        $I->logAsSuperAdmin();

        $I->click('#dropdown-user');
        $I->click(trans_choice('core.user', 2));
        $I->click(trans('core.addModel', ['currentModelName' => trans_choice('core.user', 1)]));
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

        $I->selectOption('form select[name=country_id]', $countryId);

        $I->click('#federation_id');
        $I->selectOption('form select[name=federation_id]', "Mexican Kendo Federation");
        $I->selectOption('form select[name=association_id]', "Asociación Mexiquense de Kendo, A.C.");
        $I->selectOption('form select[name=club_id]', "Naucali");
//
//        $I->attachFile('input[type="file"]',  'avatar2.png'); // TODO Aqui podria simular Dropzone de verdad

        $I->click("#save1");
        $I->seeInCurrentUrl('/users');
        $I->seeInSource(trans('msg.user_create_successful'));
        $I->seeInDatabase('ken_users',
            ['name' => $this->user->name,
                'email' => $this->user->email,
                'firstname' => $this->user->firstname,
                'lastname' => $this->user->lastname,
//                'grade_id' => $gradeId,
//                'country_id' => $countryId,
                'federation_id' => 37,
                'association_id' => 7,
                'club_id' => 7,
            ]);

        $this->user->delete();


    }

    // test
    public function it_edit_user(\AcceptanceTester $I, $scenario)
    {
        App::setLocale('en');
        $this->user = factory(User::class)->create();
        $I = new SimpleUser($scenario);
        $I->logAsUser();

        $I->dontSee(trans_choice('core.user', 2) . ' </a></li>');
        $I->logout();
        $I = new SuperAdmin($scenario);
        $I->logAsSuperAdmin();

        $I->amOnPage('/users/' . $this->user->slug . '/edit/');
//        $I->makeScreenshot('edit');

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

        $I->click('#federation_id');
        $I->selectOption('form select[name=federation_id]', "Mexican Kendo Federation");
        $I->selectOption('form select[name=association_id]', "ASOCIACION DE KENSHI DEL ESTADO DE PUEBLA, A.C.");
        $I->selectOption('form select[name=club_id]', "Nash Reinger");

        $I->click("#save1");
        $I->seeInSource(trans('msg.user_update_successful'));
        $I->seeInDatabase('ken_users',
            [   'name' => "juju2",
                'firstname' => "may",
                'lastname' => "orozco",
                'grade_id' => $gradeId,
                'country_id' => $countryId,
                'federation_id' => 37,
                'association_id' => 6,
                'club_id' => 2,
            ]);


        User::where('email', $this->user->email)->delete();

    }

    // test
    public function you_can_change_your_password_and_login_with_new_data(\AcceptanceTester $I)
    {
//        $I->simpleUser = factory(User::class)->create(    ['role_id' => Config::get('constants.ROLE_USER')]);
//        $I->logWithUser($I->simpleUser);
//        $I->visit("/users/".$I->simpleUser->slug."/edit/")
//            $I->fillField('222222', 'password')
//            $I->fillField('222222', 'password_confirmation')
//            ->press(trans('core.save'))
//            ->see(trans('msg.user_update_successful'));
//
//        //Logout
//        $I->click(trans('core.logout'))
//            ->seePageIs('auth/login');
//
//        // Login Again with new Data
//        $I$I->fillField($I->simpleUser->email, 'email')
//            $I->fillField('222222', 'password')
//            ->press(trans('auth.signin'))
//            ->seePageIs('/');

    }


}

?>