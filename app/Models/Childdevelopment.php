<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childdevelopment extends Model
{
    use HasFactory;

    protected $fillable = [
        'development_id',
        'development_answer_date',
        'development_answer_value',
        'children_id',
        'milestone_id',
        'question_id'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'development_id';
}
