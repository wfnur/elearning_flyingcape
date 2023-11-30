<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService{
    protected $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getAll(){
        return $this->userRepository->getAll();
    }

    public function store($request){
        return $this->userRepository->store($request);
    }

    public function delete($id){
        return $this->userRepository->delete($id);
    }
}

?>