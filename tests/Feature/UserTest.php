<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_getall(){
        DB::delete("delete from users");

        $user = User::factory()->create();
        $response = $this->getJson('api/user');

        $response->assertJson([$user->toArray()]);
    }

    public function test_store(){
        $payload = [
            'email' => "wahyu@gmail.com",
            'firstname' => "Wahyu",
            'lastname'=> "fajar",
            'gender'=> "male",
            'phone'=> "08888",
            'role'=> "general"
        ];

        $response = $this->postJson('api/user/store',$payload);
        $response->assertStatus(201);
        $response->assertJson($payload);
    }

    public function test_delete(){
        $user = User::factory()->create();
        $this->json('DELETE', 'api/user/delete/' . $user->id)
            ->assertStatus(200)
            ->assertJson([
                'Data' => $user->id,
                'Status' => "Deleted",
                'StatusCode' => 200,
            ]);

    }

    
}
