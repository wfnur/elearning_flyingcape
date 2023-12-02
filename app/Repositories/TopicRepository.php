<?php

namespace App\Repositories;

use App\Models\Topic;
use Exception;
use Illuminate\Support\Facades\Hash;

class TopicRepository{

    protected $topic;
    
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function getAll(){
        $topic = Topic::with("class","user")->get();
        return $topic;
    }

    public function getTopicByID($id){
        $topic = Topic::with("class","user")->find($id);
        return $topic;
    }

    public function getTopicByName($name){
        $topic = Topic::where('name','LIKE',"%{$name}%")
                    ->with("class","user")
                    ->get();
        return $topic;
    }

    public function store($request){
        $topic = Topic::create([
            'name' => $request->name,
            'description' => $request->description,
            'class_id' => $request->class_id,
            'created_by' => $request->createdby
        ]);

        return $topic;
    }

    public function delete($id){
        try {
            $topic = Topic::find($id);
            if($topic){
                $topic->delete();
                return $topic;
            }else{
                return "notFound";
            }
        } catch (Exception $er) {
            return $er->getMessage();
        }
    }
}
?>