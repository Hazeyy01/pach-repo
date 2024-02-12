<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systemquestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'question_text',
        'milestone_id'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'question_id';
}
