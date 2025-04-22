<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['code'];
    public $timestamps = false;

    public function translators()
    {
        return $this->belongsToMany(Translator::class, 'language_translator', 'language_id', 'translator_id');
    }
}