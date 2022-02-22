<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'students';
    
    protected $fillable =
    ['name',
    'regno',
    'email',
    'mobile',
    'address'
    ];
}
