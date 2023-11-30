<?php

namespace App\Services;

use App\Repositories\EnrolledClassRepository;

class EnrolledClassService{
    protected $enrolledClassRepository;

    public function __construct(EnrolledClassRepository $enrolledClassRepository){
        $this->enrolledClassRepository = $enrolledClassRepository;
    }

    public function getAll(){
        return $this->enrolledClassRepository->getAll();
    }

    public function store($request){
        return $this->enrolledClassRepository->store($request);
    }

    public function delete($id){
        return $this->enrolledClassRepository->delete($id);
    }
}

?>