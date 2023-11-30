<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'createdby'
    ];

    public function usertype()
    {
        return $this->belongsToMany(UserTypes::class, 'enrolled_classes', 'class_id', 'usertype_id');
    }

    public function topic(){
        return $this->hasMany(Topic::class);
    }

    public function user(){
        return $this->hasMany(User::class,'id','createdby');
    }
}
