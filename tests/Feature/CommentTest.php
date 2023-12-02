<?php

namespace Tests\Feature;

use App\Models\Classes;
use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getall(){
        DB::delete("delete from comments");

        //get class
        $idtopics = [];
        $topics = Topic::all();
        foreach($topics as $value){
            array_push($idtopics,$value->id);
        }
        $idtopic = $idtopics[array_rand($idtopics, 1)];

        //get iduser
        $idusers = [];
        $users = User::all();
        foreach($users as $value){
            array_push($idusers,$value->id);
        }
        $iduser = $idusers[array_rand($idusers, 1)];
        
        $payload = [
            'topic_id' => $idtopic,
            'comment' =>"Comment Test",
            'createdby' =>$iduser 
        ];

        $comment = Comment::create($payload);
        $getComment = Comment::with("topic","user")->where('id',$comment["id"])->get();

        $response = $this->getJson('api/comment');
        $response->assertJson($getComment->toArray());
    }

    public function test_store(){
        //get class
        $idtopics = [];
        $topics = Topic::all();
        foreach($topics as $value){
            array_push($idtopics,$value->id);
        }
        $idtopic = $idtopics[array_rand($idtopics, 1)];

        //get iduser
        $idusers = [];
        $users = User::all();
        foreach($users as $value){
            array_push($idusers,$value->id);
        }
        $iduser = $idusers[array_rand($idusers, 1)];

        $payload = [
            'topic_id' => $idtopic,
            'comment' =>"Comment Test",
            'createdby' =>$iduser 
        ];

        $response = $this->postJson('api/comment/store',$payload);
        $response->assertStatus(201);
        //$response->assertJsonStructure($payload);
    }

    public function test_delete(){
        //get class
        $idtopics = [];
        $topics = Topic::all();
        foreach($topics as $value){
            array_push($idtopics,$value->id);
        }
        $idtopic = $idtopics[array_rand($idtopics, 1)];

        //get iduser
        $idusers = [];
        $users = User::all();
        foreach($users as $value){
            array_push($idusers,$value->id);
        }
        $iduser = $idusers[array_rand($idusers, 1)];
        
        $payload = [
            'topic_id' => $idtopic,
            'comment' =>"Comment Test",
            'createdby' =>$iduser 
        ];

        $comment = Comment::create($payload);

        $this->json('DELETE', 'api/comment/delete/' . $comment["id"])
            ->assertStatus(200)
            ->assertJson([
                'Data' => $comment->id,
                'Status' => "Deleted",
                'StatusCode' => 200,
            ]);

    }
}
