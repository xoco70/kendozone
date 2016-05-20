<?php
namespace Step\Acceptance;

class SimpleUser extends \AcceptanceTester
{

    public function logAsUser()
    {
        $I = $this;
        $I->amOnPage('/');
        $I->fillField('email', 'user@kendozone.com');
        $I->fillField('password', 'user');
        $I->click(trans('auth.signin'));
        $I->seeCurrentUrlEquals('/');

    }

    public function logout()
    {
        $I = $this;
        $I->click('#dropdown-user');
        $I->click('#logout');
    }

}