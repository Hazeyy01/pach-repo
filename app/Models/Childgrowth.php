<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childgrowth extends Model
{
    use HasFactory;

    protected $fillable = [
        'growth_id',
        'growth_weight',
        'growth_height',
        'growth_head_circumference',
        'growth_bmi',
        'growth_date_taken',
        'growth_age_taken',
        'children_id'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'growth_id';
}
