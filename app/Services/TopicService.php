<?php

namespace App\Services;

use App\Repositories\TopicRepository;

class TopicService{
    protected $topicRepository;

    public function __construct(TopicRepository $topicRepository){
        $this->topicRepository = $topicRepository;
    }

    public function getAll(){
        return $this->topicRepository->getAll();
    }

    public function getTopicByID($id){
        return $this->topicRepository->getTopicByID($id);
    }

    public function getTopicByName($name){
        return $this->topicRepository->getTopicByName($name);
    }

    public function store($request){
        return $this->topicRepository->store($request);
    }

    public function delete($id){
        return $this->topicRepository->delete($id);
    }
}

?>