<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdatedTranslation extends Model
{
    protected $fillable = ['verification_id', 'value'];

    public function translateToUserLang(){
        // TODO
        // use api or something 
        return $this->value . "dummy translation";
    }
}
