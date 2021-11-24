<?php

namespace Tests\Feature;

use AccountSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;;

class AccountApiTest extends TestCase {
    use RefreshDatabase;
    protected array $dummyAccount;

    public function __construct() {
        parent::__construct();
        $this->dummyAccount = [
            'uid' => 'some-random-uid',
            'name' => 'some-random-name',
            'key' => 'some-random-key',
            'secret' => 'some-random-secret',
            'is_enabled' => false
        ];
    }

    public function testPostAccountWithInvalidPayload() {
        //$this->withoutExceptionHandling();
        $response = $this->json(
            'POST',
            '/api/v1/accounts',
            [],
            ['Accept' => 'application/json', 'Content-Type' => 'application/json'],
        );
        $response
            ->assertStatus(422)
            ->assertExactJson(
                [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'key' => ['The key field is required.'],
                        'secret' => ['The secret field is required.']
                    ]
                ]
            );
    }

    public function testPostAccountWithValidPayload() {
        $response = $this->json(
            'POST',
            '/api/v1/accounts',
            $this->dummyAccount,
            ['Accept' => 'application/json', 'Content-Type' => 'application/json'],
        );
        $response
            ->assertStatus(201)
            ->assertJson($this->dummyAccount);
    }

    public function testGetAccount() {
        $this->seed(AccountSeeder::class);
        $uid = 'some-random-uid';
        $response = $this->get('/api/v1/accounts/' . $uid);
        $response
            ->assertStatus(200)
            ->assertJson($this->dummyAccount);
    }

    public function testGetAccounts() {
        $this->seed(AccountSeeder::class);
        $response = $this->get('/api/v1/accounts');
        $response
            ->assertStatus(200)
            ->assertJson([
                ['uid' => $this->dummyAccount['uid'], 'name' => $this->dummyAccount['name']],
            ]);
    }

    public function testUpdateAccount() {
        $this->seed(AccountSeeder::class);
        $response = $this->json(
            'PATCH',
            '/api/v1/accounts/'.$this->dummyAccount['uid'],
            ['is_enabled' => true],
            ['Accept' => 'application/json', 'Content-Type' => 'application/json']
        );
        $response
            ->assertStatus(200)
            ->assertJson(['is_enabled' => true]);
    }

    public function testDeleteAccount() {
        $this->seed(AccountSeeder::class);
        $response = $this->json(
            'DELETE',
            '/api/v1/accounts/'.$this->dummyAccount['uid']
        );
        $response->assertStatus(200)->assertSeeText('1');
    }
}
