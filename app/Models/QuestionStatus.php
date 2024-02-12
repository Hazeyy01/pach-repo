<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'milestonequestion',
        'childdevelopment',
        'status'
    ];
}
