<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systemmilestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'milestone_id',
        'milestone_name',
        'milestone_category'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'milestone_id';
}
