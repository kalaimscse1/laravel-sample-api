<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    
    protected $table = 'blogs';
    
    protected $fillable =
    ['title',
    'post',
    'user_id'
    ];
}
