<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenVaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'immunization',
        'vaccine'
    ];
}
