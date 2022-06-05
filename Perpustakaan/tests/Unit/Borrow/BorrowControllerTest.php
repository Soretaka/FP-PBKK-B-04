<?php

namespace Tests\Unit\Borrow;

use Tests\TestCase;

class BorrowControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_store_data_successfully_borrow()
    {
        $response = $this->post('/borrow/store', [
            'must_return_date' => '2022-07-12',
            'user_id' => 2,
            'admin_id' => 1
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/borrow');
    }

    public function test_store_data_failed_borrow()
    {
        $response = $this->post('/borrow/store', [
            'must_return_date' => '2022-07-12',
            'user_id' => 2,
            'admin_id' => 1
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
