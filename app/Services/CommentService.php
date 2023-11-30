<?php

namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository){
        $this->commentRepository = $commentRepository;
    }

    public function getAll(){
        return $this->commentRepository->getAll();
    }

    public function getCommentByTopic($id){
        return $this->commentRepository->getCommentByTopic($id);
    }

    public function store($request){
        return $this->commentRepository->store($request);
    }

    public function delete($id){
        return $this->commentRepository->delete($id);
    }
}

?>