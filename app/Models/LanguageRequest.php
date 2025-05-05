<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageRequest extends Model
{
    //

    public function language() {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }
    
}
