<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childimmunization extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_immunization_id',
        'child_immunization_date',
        'child_immunization_type',
        'vaccine_name',
        'vaccine_id',
        'children_id'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'child_immunization_id';
}
