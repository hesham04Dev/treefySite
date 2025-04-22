<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Verification.php
class Verification extends Model {
    protected $fillable = ['translator_id', 'is_correct'];
}
