<?php

namespace Tests\Unit\Member;

use Tests\TestCase;

class MemberControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_store_data_successfully_member()
    {
        $response = $this->post('/member/store', [
            'image' => 'image.jpg',
            'nama' => 'member_test',
            'nis' => '123',
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => 'place_test',
            'tanggal_lahir' => '2022-06-12',
            'nomor_hp' => '081348340681'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/member');
    }

    public function test_store_data_failed_member()
    {
        $response = $this->post('/member/store', [
            'image' => 'image.jpg',
            'nama' => '',
            'nis' => '',
            'jenis_kelamin' => '',
            'tempat_lahir' => '',
            'tanggal_lahir' => '2022-06-12',
            'nomor_hp' => ''
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
