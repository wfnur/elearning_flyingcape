<?php

namespace App\Repositories;

use App\Models\Comment;
use Exception;
use Illuminate\Support\Facades\Hash;

class CommentRepository{

    protected $comment;
    
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getAll(){
        $comments = Comment::with("topic","user")->get();
        return $comments;
    }

    public function getTopicByID($id){
        $comments = Comment::with("topic","user")->find($id);
        return $comments;
    }

    public function getCommentByTopic($id){
        $comments = Comment::where('topic_id','=',$id)
                    ->with("topic","user")
                    ->get();
        return $comments;
    }

    public function store($request){
        $comments = Comment::create([
            'comment' => $request->comment,
            'topic_id' => $request->topic_id,
            'createdby' => $request->createdby,
        ]);

        return $comments;
    }

    public function delete($id){
        try {
            $comments = Comment::find($id);
            if($comments){
                $comments->delete();
                return $comments;
            }else{
                return "notFound";
            }
        } catch (Exception $er) {
            return $er->getMessage();
        }
    }
}
?>