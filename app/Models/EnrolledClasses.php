<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolledClasses extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'user_id',
        'usertype_id',
    ];
}
