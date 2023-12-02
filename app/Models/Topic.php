<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'class_id',
        'createdby'
    ];

    public function class(){
        return $this->belongsTo(Classes::class);
    }

    public function comment(){
        return $this->belongsTo(Comment::class);
    }

    public function user(){
        return $this->hasMany(User::class,'id','createdby');
    }


}
