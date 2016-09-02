<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;


class CategoryTest extends TestCase
{
    use DatabaseTransactions;


    public function setUp()
    {
        parent::setUp();
        $this->simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

    }


    /** @test
     *TODO a completar
     * superAdmin can do everything
     */
    public function create_category()
    {
        $this->json('POST', '/user', ['name' => 'Sally'])
            ->seeJson([
                'created' => true,
            ]);
    }

    /** @test
     *
     * a user must be superAdmin to access federation
     */

}
