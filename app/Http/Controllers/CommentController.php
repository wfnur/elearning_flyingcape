<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Exception;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index(Request $request){
        try {
            if ($request->has('idTopic')) {
                $results= $this->commentService->getCommentByTopic($request->input('idTopic'));
            }
            else
            {
                $results = $this->commentService->getAll();
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

    
    public function store(Request $request){
        try {
            $results= $this->commentService->store($request);
           
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
            $user = $this->commentService->delete($id);
            if($user == "notFound"){
                throw new Exception('comment not found');
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
