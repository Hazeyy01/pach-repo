<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systemtip extends Model
{
    use HasFactory;

    protected $fillable = [
        'tip_id',
        'tip_title',
        'tip_category',
        'tip_sub_category',
        'tip_content',
        'tip_video_url',
        'tip_image_name',
        'tip_image_file',
        'admin_id'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'tip_id';
}
