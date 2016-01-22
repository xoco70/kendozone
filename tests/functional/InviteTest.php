<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InviteTest extends TestCase
{
    /**
     * Tests inside:
     * 0. Generate an invite with key
     * 1. Send mails and success
     * 2. Click mail and add to tournament
     * 3. Click mail, register and add to tournament
     * 4. Click mail and deny - used invitation
     * 5. Click mail and deny - invitation disabled
     *
     */

    use DatabaseTransactions;

    public function setUp()
    {

    }
    /** @test */
    public function it_generate_an_invite()
    {

    }

    public function user_register_a_tournament()
    {

    }

}
