<?php

namespace App\Http\Controllers;

use App\Services\EnrolledClassService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\IsEmpty;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    private $userService,$enrolledClassService;

    public function __construct(UserService $userService,EnrolledClassService $enrolledClassService)
    {
        $this->userService = $userService;
        $this->enrolledClassService = $enrolledClassService;
    }

    public function index(){
        try {
            $users = $this->userService->getAll();
            return $users;

        } catch (Exception $e) {
            $results=[
                'Status' => "Error",
                'StatusCode' => 500,
                'Data' =>$e->getMessage()
            ];
            return $results;
        }        
    }

    public function getEnrolledByID($id,$usertype){
        try {
            $users = $this->userService->getEnrolledClassByID($id,$usertype);
            return $users;

        } catch (Exception $e) {
            $results=[
                'Status' => "Error",
                'StatusCode' => 500,
                'Data' =>$e->getMessage()
            ];
            return $results;
        }   
        $data=[];
        $users = $this->userService->getAll();
        foreach($users as $value){
            if(count($value["enrolled_classes"]) > 0){
                foreach($value["enrolled_classes"] as $res){
                    array_push($data,$res);
                    if($res["usertype"] == "Student"){
                        $newData = [
                            'id' =>$value["id"],
                            'usertype' =>$res["usertype"],
                        ];
                    }
                }
            }
        }
        return $data;
        
    }

    public function getUserByID($id){
        try {
            $users = $this->userService->getUserByID($id);
            return $users;

        } catch (Exception $e) {
            $results=[
                'Status' => "Error",
                'StatusCode' => 500,
                'Data' =>$e->getMessage()
            ];
            return $results;
        }        
    }

    public function store(Request $request){
        try {
            $users = $this->userService->store($request);
            return $users;

        } catch (Exception $e) {
            $results=[
                'Status' => "Error",
                'StatusCode' => 500,
                'Data' =>$e->getMessage()
            ];
            return $results;
        }
    }

    public function delete($id){
        try {
            $user = $this->userService->delete($id);
            if($user == "notFound"){
                throw new Exception('user not found');
            }else{
                $results["Data"] = $id;
                $results["Status"] = "Deleted";
                $results["StatusCode"] = 200;
            }
            
        } catch (Exception $e) {
            $results=[
                'Status' => "Error",
                'StatusCode' => 500,
                'Data' =>$e->getMessage()
            ];
        }

        return $results;
    }

    public function enrollclass(Request $request){
        try {
            $results["Data"] = $this->enrolledClassService->store($request);
            $results["Status"] = "Created";
            $results["StatusCode"] = 201;

        } catch (Exception $e) {
            $results=[
                'Status' => "Error",
                'StatusCode' => 500,
                'Data' =>$e->getMessage()
            ];
        }

        return $results;
    }
}
