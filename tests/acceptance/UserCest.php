<?php

class UserCest
{
    // test
    public function it_create_user(\AcceptanceTester $I)
    {
//        $this->logWithUser($this->simpleUser);
//        $this->visit('/')->dontSee(trans_choice('core.user', 2) . ' </a></li>');
//
//        $this->logWithUser($this->root);
//
//        $test_file_path = base_path() . '/avatar2.png';
////        dd($test_file_path);
//        $this->assertTrue(file_exists($test_file_path), 'Test file does not exist');
//
//
//        $this->visit('/')
//            ->click(trans_choice('core.user', 2))
////            ->see(trans_choice('core.user', 2))
//            ->click(trans('core.addModel', ['currentModelName' => trans_choice('core.user', 1)]))
//            ->type('MyUser', 'name')
//            ->type('julien@cappiello.fr2', 'email')
//            ->type('julien', 'firstname')
//            ->type('cappiello', 'lastname')
//            ->type('111111', 'password')
//            ->type('111111', 'password_confirmation')
//            ->attach($test_file_path, 'avatar')
////            //File input avatar
//            ->press(trans('core.save'))
//            ->seePageIs('/users')
//            ->see(trans('msg.user_create_successful'))
//            ->seeInDatabase('users', ['name' => 'MyUser']);
//
//        $user = User::where('name', 'MyUser')->first();
//        File::delete(base_path() . '/' . $user->avatar);

    }

    // test
    public function it_edit_user(\AcceptanceTester $I)
    {

//        $this->logWithUser($this->simpleUser);
//        $this->visit('/')->dontSee(trans_choice('core.user', 2) . ' </a></li>');
//
//        $this->logWithUser($this->root);
//
//
//        $this->visit('/users')
//            ->click($this->simpleUser->name)
//            ->type('juju', 'name')
//            ->type('juju@juju.com', 'email')
//            ->type('may', 'firstname')
//            ->type('1', 'lastname')
//            ->type('222222', 'password')
//            ->type('222222', 'password_confirmation')
//            ->type('44', 'avatar')
//            ->press(Lang::get('core.save'))
//            ->seePageIs('/users/')
//            ->seeInDatabase('users', ['name' => 'juju', 'email' => 'juju@juju.com']);
    }

    // test
    public function you_can_change_your_password_and_login_with_new_data(\AcceptanceTester $I)
    {
//        $this->simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);
//        $this->logWithUser($this->simpleUser);
//        $this->visit("/users/".$this->simpleUser->slug."/edit/")
//            ->type('222222', 'password')
//            ->type('222222', 'password_confirmation')
//            ->press(trans('core.save'))
//            ->see(trans('msg.user_update_successful'));
//
//        //Logout
//        $this->click(trans('core.logout'))
//            ->seePageIs('auth/login');
//
//        // Login Again with new Data
//        $this->type($this->simpleUser->email, 'email')
//            ->type('222222', 'password')
//            ->press(trans('auth.signin'))
//            ->seePageIs('/');

    }
    public function logWithUser($newUser)
    {
        Auth::loginUsingId($newUser->id);
        Lang::setLocale($newUser->locale);
    }
}

?>