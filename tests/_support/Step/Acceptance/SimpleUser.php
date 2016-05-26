<?php
namespace Step\Acceptance;

use Illuminate\Support\Facades\App;

class SimpleUser extends \AcceptanceTester
{

    public function logAsUser()
    {
        $I = $this;
        $I->amOnPage('/');
        $I->fillField('email', 'user@kendozone.com');
        $I->fillField('password', 'user');
        $I->click("#login");
        $I->seeCurrentUrlEquals('/');

    }

    public function logout()
    {
        $I = $this;
        $I->click('#dropdown-user');
        $I->click('#logout');
    }

}