<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Project.php
class Project extends Model {
    protected $fillable = ['user_id', 'name', 'desc', 'points_per_word', 'verification_no'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function translators() {
        return $this->belongsToMany(Translator::class);
    }
}

