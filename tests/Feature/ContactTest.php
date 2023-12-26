<?php

namespace Tests\Feature;

use App\Models\Contact;
use Database\Seeders\ContactSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    public function testCreateSuccess()
    {

        $this->post('/api/contacts', [
            'first_name' => 'Eko',
            'last_name' => 'Khannedy',
            'email' => 'eko@pzn.com',
            'phone' => '03242343243'
        ])->assertStatus(201)
            ->assertJson([
                'data' => [
                    'first_name' => 'Eko',
                    'last_name' => 'Khannedy',
                    'email' => 'eko@pzn.com',
                    'phone' => '03242343243'
                ]
            ]);
    }

    // public function testCreateFailed()
    // {
    //     $this->post('/api/contacts', [
    //         'first_name' => '',
    //         'last_name' => 'Khannedy',
    //         'email' => 'eko',
    //         'phone' => '03242343243'
    //     ], [
    //         'Authorization' => 'test'
    //     ])->assertStatus(400)
    //         ->assertJson([
    //             'errors' => [
    //                 'first_name' => [
    //                     'The first name field is required.'
    //                 ],
    //                 'email' => [
    //                     'The email field must be a valid email address.'
    //                 ]
    //             ]
    //         ]);
    // }
}
