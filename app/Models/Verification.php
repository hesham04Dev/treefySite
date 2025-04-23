<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Verification.php
class Verification extends Model {
    protected $fillable = ['translator_id', 'is_correct'];


    public function translation(){
        return $this->belongsTo(Translation::class, 'translations_id');
    }
    public function translator(){
        return $this->belongsTo(Translator::class, 'translator_id');
    }
}
