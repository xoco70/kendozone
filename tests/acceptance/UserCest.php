<?php

use App\Grade;
use App\User;
use Faker\Factory as Faker;
use Step\Acceptance\SimpleUser;
use Step\Acceptance\SuperAdmin;

class UserCest
{
    // test
    public function it_create_user(\AcceptanceTester $I, $scenario)
    {
        App::setLocale('en');
        $user = factory(User::class)->make();

        $I = new SimpleUser($scenario);
        $I->logAsUser();
        $I->dontSee(trans_choice('core.user', 2) . ' </a></li>');
        $I->logout();
        $I = new SuperAdmin($scenario);
        $I->logAsSuperAdmin();

        $I->click('#dropdown-user');
        $I->click(trans_choice('core.user', 2));
        $I->click(trans('core.addModel', ['currentModelName' => trans_choice('core.user', 1)]));
        $I->fillField('name', $user->name);
        $I->fillField('email', $user->email);
        $I->fillField('firstname', $user->firstname);
        $I->fillField('lastname', $user->lastname);
        $I->fillField('password', '111111');
        $I->fillField('password_confirmation', '111111');

        $grades = Grade::all()->pluck('name')->toArray();
        $countries = Countries::all()->pluck('name')->toArray();

        $faker = Faker::create();
        $gradeId = $faker->randomElement($grades);
        $countryId = $faker->randomElement($countries);

        $I->selectOption('form select[name=grade_id]', $gradeId);

        $I->selectOption('form select[name=country_id]', $countryId);

        $I->click('#federation_id');
        $I->selectOption('form select[name=federation_id]', "Mexican Kendo Federation");
        $I->selectOption('form select[name=association_id]', "Asociación Mexiquense de Kendo, A.C.");
        $I->selectOption('form select[name=club_id]', "Naucali");
//
//        $I->attachFile('input[type="file"]',  'avatar2.png'); // TODO Aqui podria simular Dropzone de verdad
        $I->makeScreenshot('save');

        $I->click("#save1");
        $I->seeInCurrentUrl('/users');
        $I->seeInSource(trans('msg.user_create_successful'));
        $I->seeInDatabase('ken_users',
            ['name' => $user->name,
                'email' => $user->email,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
//                'grade_id' => $gradeId,
//                'country_id' => $countryId,
                'federation_id' => 37,
                'association_id' => 7,
                'club_id' => 7,
            ]);
//
//        $user = User::where('name', 'MyUser')->first();
//        File::delete(base_path() . '/' . $user->avatar);

    }

    // test
    public function it_edit_user(\AcceptanceTester $I)
    {

//        $I->logWithUser($I->simpleUser);
//        $I->visit('/')->dontSee(trans_choice('core.user', 2) . ' </a></li>');
//
//        $I->logWithUser($I->root);
//
//
//        $I->visit('/users')
//            ->click($I->simpleUser->name)
//            $I->fillField('juju', 'name')
//            $I->fillField('juju@juju.com', 'email')
//            $I->fillField('may', 'firstname')
//            $I->fillField('1', 'lastname')
//            $I->fillField('222222', 'password')
//            $I->fillField('222222', 'password_confirmation')
//            $I->fillField('44', 'avatar')
//            ->press(Lang::get('core.save'))
//            ->seePageIs('/users/')
//            ->seeInDatabase('users', ['name' => 'juju', 'email' => 'juju@juju.com']);
    }

    // test
    public function you_can_change_your_password_and_login_with_new_data(\AcceptanceTester $I)
    {
//        $I->simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
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
//    public function logWithUser(User $newUser)
//    {
//        Auth::loginUsingId($newUser->id);
//        Lang::setLocale($newUser->locale);
//    }


}

?>