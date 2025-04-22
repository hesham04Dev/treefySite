<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageVerification extends Model
{
    protected $fillable = ['lang', 'path', 'key_no', 'project_id'];
}
