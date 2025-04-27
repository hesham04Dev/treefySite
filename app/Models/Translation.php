<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = ['key_id', 'project_id', 'language_id', 'value'];

    public function key()
    {
        return $this->belongsTo(TranslationKey::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function verifications(){
        return $this->hasMany(Verification::class);
    }
}
