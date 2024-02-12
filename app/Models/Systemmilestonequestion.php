<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systemmilestonequestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'milestone_question_id',
        'milestone_id',
        'question_id'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'milestone_question_id';
}
