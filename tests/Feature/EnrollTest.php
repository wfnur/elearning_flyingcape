<?php

namespace Tests\Feature;

use App\Models\Classes;
use App\Models\User;
use App\Models\UserTypes;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class EnrollTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_enrolluser_to_class()
    {
        DB::delete("delete from enrolled_classes");
        //get iduser
        $idusers = [];
        $users = User::all();
        foreach($users as $value){
            array_push($idusers,$value->id);
        }
        $iduser = $idusers[array_rand($idusers, 1)];

        //get class
        $idclasses = [];
        $classes = Classes::all();
        foreach($classes as $value){
            array_push($idclasses,$value->id);
        }
        $idclass = $idclasses[array_rand($idclasses, 1)];

        //get usertype
        $idcusertypes = [];
        $usertypes = UserTypes::all();
        foreach($usertypes as $value){
            array_push($idcusertypes,$value->id);
        }
        $idcusertype = $idcusertypes[array_rand($idcusertypes, 1)];

        $payload = [
            'user_id' => $iduser,
            'class_id' => $idclass,
            'usertype_id' =>$idcusertype
        ];

        $response = $this->postJson('api/user/enrollclass',$payload);
        $response->assertJson([
            'Data' => $payload,
            'Status' => "Created",
            'StatusCode' => 201,
        ]);
    }

    public function test_enrolledclass(){
        $data=[];
        $users = $this->app->make(UserService::class)->getAll();
        foreach($users as $value){
            if(count($value["enrolled_classes"]) > 0){
                foreach($value["enrolled_classes"] as $res){
                    array_push($data,$res);
                    $newData = [
                        'id' =>$value["id"],
                        'usertype' =>$res["usertype"],
                    ];
                }
            }
        }

        $response = $this->getJson('api/user/'.$newData["id"].'/'.$newData["usertype"].'');
        $response->assertJson($data);
    }
}
