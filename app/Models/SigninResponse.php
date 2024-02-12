<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SigninResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_type',
        'response_status',
        'response_message'
    ];
}
