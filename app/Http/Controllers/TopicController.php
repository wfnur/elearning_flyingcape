<?php

namespace App\Http\Controllers;

use App\Services\TopicService;
use Exception;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    private $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }

    public function index(Request $request){
        try {
            if ($request->has('name')) {
                $results["Data"] = $this->topicService->getTopicByName($request->input('name'));
            }
            else
            {
                $results["Data"] = $this->topicService->getAll();
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

    public function getTopicbyID($id){
        try {
            $results["Data"] = $this->topicService->getTopicbyID($id);
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
            $results["Data"] = $this->topicService->store($request);
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
            $user = $this->topicService->delete($id);
            if($user == "notFound"){
                throw new Exception('topic not found');
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
