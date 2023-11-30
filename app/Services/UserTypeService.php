<?php

namespace App\Services;

use App\Repositories\UserTypeRepository;

class UserTypeService{
    protected $userTypeRepository;

    public function __construct(UserTypeRepository $userTypeRepository){
        $this->userTypeRepository = $userTypeRepository;
    }

    public function getAll(){
        return $this->userTypeRepository->getAll();
    }

    public function getUserTypebyID($id){
        return $this->userTypeRepository->getUserTypebyID($id);
    }

    public function getUserTypebyName($name){
        return $this->userTypeRepository->getUserTypebyName($name);
    }

    public function store($request){
        return $this->userTypeRepository->store($request);
    }

    public function delete($id){
        return $this->userTypeRepository->delete($id);
    }
}

?>