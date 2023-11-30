<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'comment',
        'createdby'
    ];

    public function topic(){
        return $this->belongsTo(Topic::class);
    }

    public function user(){
        return $this->hasMany(User::class,'id','createdby');
    }
}
