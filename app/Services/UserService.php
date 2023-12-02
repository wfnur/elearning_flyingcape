<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService{
    protected $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getAll(){
        $users =  $this->userRepository->getAll()->toArray();
        $results = [];
        foreach($users as $value){
            array_push($results,$this->UserFormatter($value));
        }
        return $results;
    }

    public function getUserByID($id){
        $user = $this->userRepository->getUserByID($id)->toArray();
        $result = $this->UserFormatter($user);
        return $result;
    }

    public function getEnrolledClassByID($id,$usrtype){
        $users = $this->getUserByID($id);
        $enrolledclass_as = [];

        foreach($users["enrolled_classes"] as $value){
            if($value["usertype"] == $usrtype){
                array_push($enrolledclass_as,$value);
            }
        }
        return $enrolledclass_as;
    }

    public function store($request){
        return $this->userRepository->store($request);
    }

    public function delete($id){
        return $this->userRepository->delete($id);
    }

    public function UserFormatter($data){
        $classes = [];
        $newData["id"] = $data["id"];
        $newData["email"] = $data["email"];
        $newData["firstname"] = $data["firstname"];
        $newData["lastname"] = $data["lastname"];
        $newData["gender"] = $data["gender"];
        $newData["phone"] = $data["phone"];
        $newData["enrolled_classes"] = [] ;
        //if have classes
        if($data["enrolled_classes"] != null){
            foreach($data["enrolled_classes"] as $value){
                //if have usertype
                if(count($value["usertype"]) > 0){
                    foreach($value["usertype"] as $res){
                        
                        $usertype = $res["usertype"] ;
                    }
                }else{
                    $usertype = null ;
                }

                $class = [
                    'name'=>$value["name"],
                    'description'=>$value["description"],
                    'usertype'=> $usertype,
                ];
                array_push($classes,$class);

                
            }
            $newData["enrolled_classes"] = $classes ;
        }
       
        return $newData;;
    }
    
}

?>