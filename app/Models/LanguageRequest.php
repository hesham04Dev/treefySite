<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageRequest extends Model
{
    //

    public function language() {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function translator(){
        return $this->belongsTo(Translator::class,"translator_id" ,"user_id");
    }
    public function user(){
        return $this->translator?->user;
    }
    
}
