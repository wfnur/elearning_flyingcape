<?php

namespace Tests\Feature;

use App\Models\Classes;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TopicTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getall(){
        DB::delete("delete from topics");

        //get class
        $idclasses = [];
        $classes = Classes::all();
        foreach($classes as $value){
            array_push($idclasses,$value->id);
        }
        $idclass = $idclasses[array_rand($idclasses, 1)];

        //get iduser
        $idusers = [];
        $users = User::all();
        foreach($users as $value){
            array_push($idusers,$value->id);
        }
        $iduser = $idusers[array_rand($idusers, 1)];

        
        $payload = [
            'class_id' => $idclass,
            'name' =>"Topic Test",
            'description'=>"desc",
            'createdby' =>$iduser 
        ];

        $topic = Topic::create($payload);
        $getTopic = Topic::with("class","user")->where('id',$topic["id"])->get();

        $response = $this->getJson('api/topic');
        $response->assertJson($getTopic->toArray());
    }

    public function test_store(){
        //get class
        $idclasses = [];
        $classes = Classes::all();
        foreach($classes as $value){
            array_push($idclasses,$value->id);
        }
        $idclass = $idclasses[array_rand($idclasses, 1)];

        //get iduser
        $idusers = [];
        $users = User::all();
        foreach($users as $value){
            array_push($idusers,$value->id);
        }
        $iduser = $idusers[array_rand($idusers, 1)];

        $payload = [
            'class_id' => $idclass,
            'name' =>"Topic Test",
            'description'=>"desc",
            'createdby' =>$iduser 
        ];

        $response = $this->postJson('api/topic/store',$payload);
        $response->assertStatus(201);
        //$response->assertJsonStructure($payload);
    }

    public function test_delete(){
        //get class
        $idclasses = [];
        $classes = Classes::all();
        foreach($classes as $value){
            array_push($idclasses,$value->id);
        }
        $idclass = $idclasses[array_rand($idclasses, 1)];

        //get iduser
        $idusers = [];
        $users = User::all();
        foreach($users as $value){
            array_push($idusers,$value->id);
        }
        $iduser = $idusers[array_rand($idusers, 1)];

        
        $payload = [
            'class_id' => $idclass,
            'name' =>"Topic Test",
            'description'=>"desc",
            'createdby' =>$iduser 
        ];

        $topic = Topic::create($payload);

        $this->json('DELETE', 'api/topic/delete/' . $topic["id"])
            ->assertStatus(200)
            ->assertJson([
                'Data' => $topic->id,
                'Status' => "Deleted",
                'StatusCode' => 200,
            ]);

    }

}
