<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systemchildren extends Model
{
    use HasFactory;

    protected $fillable = [
        'children_id',
        'children_name',
        'children_gender',
        'children_birthdate',
        'parent_id'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'children_id';
}
