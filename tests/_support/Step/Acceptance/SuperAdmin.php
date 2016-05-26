<?php
namespace Step\Acceptance;

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
    }
    public function logout(){
        $I = $this;
        $I->click('#dropdown-user');
        $I->click('#logout');
    }
    

}