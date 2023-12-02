<?php

namespace Tests\Feature;

use App\Models\Classes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ClassTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getall(){
        DB::delete("delete from classes");

        $class = Classes::factory()->create();
        $response = $this->getJson('api/class');

        $response->assertJson([$class->toArray()]);
    }

    public function test_store(){
        $payload = [
            'name' => "test class",
            'description' => "test class Description",
        ];

        $response = $this->postJson('api/class/store',$payload);
        $response->assertStatus(201);
        $response->assertJson($payload);
    }

    public function test_delete(){
        $class = Classes::factory()->create();
        $this->json('DELETE', 'api/class/delete/' . $class->id)
            ->assertStatus(200)
            ->assertJson([
                'Data' => $class->id,
                'Status' => "Deleted",
                'StatusCode' => 200,
            ]);

    }
}
