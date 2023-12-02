<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserRepository{

    protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll(){
        $users = User::with('enrolledClasses.usertype')->get();
        return $users;
    }

    public function getUserByID($id){
        $users = User::with('enrolledClasses.usertype')->find($id);
        return $users;
    }

    public function store($request){
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'firstname' => $request->firstname,
            'lastname'=> $request->lastname,
            'gender'=> $request->gender,
            'phone'=> $request->phone,
            'role'=> $request->role
        ]);

        return $user;
    }

    public function delete($id){
        try {
            $user = User::find($id);
            if($user){
                $user->delete();
                return $user;
            }else{
                return "notFound";
            }
        } catch (Exception $er) {
            return $er->getMessage();
        }
    }
}
?>