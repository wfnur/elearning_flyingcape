<?php

namespace App\Repositories;

use App\Models\EnrolledClasses;
use Exception;
use Illuminate\Support\Facades\Hash;

class EnrolledClassRepository{

    protected $enrolledClasses;
    
    public function __construct(EnrolledClasses $enrolledClasses)
    {
        $this->enrolledClasses = $enrolledClasses;
    }

    public function getAll(){
        $EnrolledClasses = EnrolledClasses::all();
        return $EnrolledClasses;
    }

    public function getEnrolledClassbyID($id){
        $EnrolledClasses = EnrolledClasses::find($id);
        return $EnrolledClasses;
    }

    public function store($request){
        $EnrolledClasses = EnrolledClasses::create([
            'class_id' => $request->class_id,
            'user_id' => $request->user_id,
            'usertype_id' => $request->usertype_id,
        ]);

        return $EnrolledClasses;
    }

    public function delete($id){
        try {
            $EnrolledClasses = EnrolledClasses::find($id);
            if($EnrolledClasses){
                $EnrolledClasses->delete();
                return $EnrolledClasses;
            }else{
                return "notFound";
            }
        } catch (Exception $er) {
            return $er->getMessage();
        }
    }
}
?>