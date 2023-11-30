<?php

namespace App\Http\Controllers;

use App\Services\UserTypeService;
use Exception;
use Illuminate\Http\Request;

class UserTypesController extends Controller
{
    private $userTypeService;

    public function __construct(UserTypeService $userTypeService)
    {
        $this->userTypeService = $userTypeService;
    }

    public function index(Request $request){
        try {
            if ($request->has('name')) {
                $results["Data"] = $this->userTypeService->getUserTypebyName($request->input('name'));
            }
            else
            {
                $results["Data"] = $this->userTypeService->getAll();
            }
            
            $results["Status"] = "Success";
            $results["StatusCode"] = 200;

        } catch (Exception $e) {
            $results=[
                'Status' => "Error",
                'StatusCode' => 500,
                'Data' =>$e->getMessage()
            ];
        }
        return $results;
        
    }

    public function getClassbyID($id){
        try {
            $results["Data"] = $this->userTypeService->getUserTypebyID($id);
            $results["Status"] = "Success";
            $results["StatusCode"] = 200;

        } catch (Exception $e) {
            $results=[
                'Status' => "Error",
                'StatusCode' => 500,
                'Data' =>$e->getMessage()
            ];
        }
        return $results;
    }

    public function store(Request $request){
        try {
            $results["Data"] = $this->userTypeService->store($request);
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

    public function delete($id){
        try {
            $user = $this->userTypeService->delete($id);
            if($user == "notFound"){
                throw new Exception('user type not found');
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
}
