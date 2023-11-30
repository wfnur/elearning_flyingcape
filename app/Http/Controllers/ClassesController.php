<?php

namespace App\Http\Controllers;

use App\Services\ClassService;
use Exception;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    private $classService;

    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    public function index(Request $request){
        try {
            if ($request->has('name')) {
                $results["Data"] = $this->classService->getClassbyName($request->input('name'));
            }
            else
            {
                $results["Data"] = $this->classService->getAll();
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
            $results["Data"] = $this->classService->getClassbyID($id);
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
            $results["Data"] = $this->classService->store($request);
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
            $user = $this->classService->delete($id);
            if($user == "notFound"){
                throw new Exception('class not found');
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
