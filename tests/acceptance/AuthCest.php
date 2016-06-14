<?php

class AuthCest
{
    // test
    public function loginGoogle(\AcceptanceTester $I)
    {
        App::setLocale('en');

        Auth::logout();
        $I->amOnPage('/auth/login');
        $I->click('#google');
        $I->fillField('Email', 'julien@t4b.mx');
        $I->click('#next');
        $I->wait(1);
        $I->fillField('Passwd', 'Zee1shoo');
        $I->click('#signIn');
        $I->see(env('APP_NAME')); // Footer is the only common screen

    }


    // test
    public function loginFB(\AcceptanceTester $I)
    {
        App::setLocale('en');

        Auth::logout();
        $I->amOnPage('/auth/login');
        $I->click('#fb');
        $I->fillField('email', 'xoco70@hotmail.com');
        $I->fillField('pass', 'Zee1shoo');
        $I->click('login'); // press???
        $I->see(env('APP_NAME')); // Footer is the only common screen

    }

    

}


?>