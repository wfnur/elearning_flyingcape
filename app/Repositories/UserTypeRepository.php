<?php

namespace App\Repositories;

use App\Models\UserTypes;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserTypeRepository{

    protected $userTypes;
    
    public function __construct(UserTypes $userTypes)
    {
        $this->userTypes = $userTypes;
    }

    public function getAll(){
        $userTypes = UserTypes::all();
        return $userTypes;
    }

    public function getUserTypebyID($id){
        $userTypes = UserTypes::find($id);
        return $userTypes;
    }

    public function getUserTypebyName($name){
        $userTypes = UserTypes::where('usertype','LIKE',"%{$name}%")->get();
        return $userTypes;
    }

    public function store($request){
        $userTypes = UserTypes::create([
            'usertype' => $request->name,
            'description' => $request->description,
        ]);

        return $userTypes;
    }

    public function delete($id){
        try {
            $userTypes = UserTypes::find($id);
            if($userTypes){
                $userTypes->delete();
                return $userTypes;
            }else{
                return "notFound";
            }
        } catch (Exception $er) {
            return $er->getMessage();
        }
    }
}
?>