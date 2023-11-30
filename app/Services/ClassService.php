<?php

namespace App\Services;

use App\Repositories\ClassRepository;

class ClassService{
    protected $classRepository;

    public function __construct(ClassRepository $classRepository){
        $this->classRepository = $classRepository;
    }

    public function getAll(){
        return $this->classRepository->getAll();
    }

    public function getClassbyID($id){
        return $this->classRepository->getClassbyID($id);
    }

    public function getClassbyName($name){
        return $this->classRepository->getClassbyName($name);
    }

    public function store($request){
        return $this->classRepository->store($request);
    }

    public function delete($id){
        return $this->classRepository->delete($id);
    }
}

?>