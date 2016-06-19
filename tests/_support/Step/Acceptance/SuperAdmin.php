<?php
namespace Step\Acceptance;

use App\User;

class SuperAdmin extends \AcceptanceTester
{

    public function logAsSuperAdmin()
    {
        $I = $this;
        $I->amOnPage('/');
        $I->fillField('email', 'superuser@kendozone.com');
        $I->fillField('password', 'superuser');
        $I->click("#login");
        $I->seeCurrentUrlEquals('/');
        $user = User::where('email','superuser@kendozone.com')->first();
        app()->setLocale($user->locale);

    }
    public function logout(){
        $I = $this;
        $I->click('#dropdown-user');
        $I->click('#logout');
    }
    

}