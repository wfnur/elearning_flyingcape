<?php

namespace App\Repositories;

use App\Models\Classes;
use Exception;
use Illuminate\Support\Facades\Hash;

class ClassRepository{

    protected $class;
    
    public function __construct(Classes $class)
    {
        $this->class = $class;
    }

    public function getAll(){
        $class = Classes::with('user')->get();
        return $class;
    }

    public function getClassbyID($id){
        $class = Classes::with('user')->find($id);
        return $class;
    }

    public function getClassbyName($name){
        $class = Classes::where('name','LIKE',"%{$name}%")
                            ->with('user')
                            ->get();
        return $class;
    }

    public function store($request){
        $class = Classes::create([
            'name' => $request->name,
            'description' => $request->description,
            'createdby' => $request->createdby,
        ]);

        return $class;
    }

    public function delete($id){
        try {
            $class = Classes::find($id);
            if($class){
                $class->delete();
                return $class;
            }else{
                return "notFound";
            }
        } catch (Exception $er) {
            return $er->getMessage();
        }
    }
}
?>