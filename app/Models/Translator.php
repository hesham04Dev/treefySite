<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Translator.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Translator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_accepted',
        'cv_id',
        'desc',
        'level',
        'exp',
    ];
    public $timestamps = false;
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'int';  

    public function user()
    {
        return $this->belongsTo(User::class,);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_translator', 'translator_id', 'language_id');
    }

    public function enrolledProjects(){
        return $this->belongsToMany(Project::class, 'project_translator', 'translator_id', 'project_id');
    }
}

