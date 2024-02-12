<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systemvaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaccine_id',
        'vaccine_name',
        'vaccine_age'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'vaccine_id';
}
