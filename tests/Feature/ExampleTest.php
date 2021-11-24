<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase {
    public function testGetStatus() {
        $response = $this->get('/api/status');
        $response->assertStatus(200);
        $response->assertExactJson(["status" => "OK"]);
    }
}
