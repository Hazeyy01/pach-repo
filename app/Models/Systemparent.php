<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systemparent extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'parent_id',
        'parent_name',
        'parent_email',
        'parent_password'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'parent_id';
}
