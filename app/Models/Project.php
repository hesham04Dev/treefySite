<?php

namespace App\Models;

use DB;
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

    public function translations() {
        return $this->hasMany(Translation::class);
    }

    public function getPercentage(){

        $total = $this->translations()->count();
        $total *= $this->verification_no;

        // if()
        // $verified = $this->verifications()->count();
        // $verified = 0;
        // return "$total - $verified";
        $done =  $this->translations()->where("skipped","1")->orWhere("is_done","1")->count();
        return($total > 0) ?  round(($done / $total) * 100) : 0;
    }

    public function verifications(){
       return DB::table('verifications')
            ->join('translations', 'verifications.translation_id', '=', 'translations.id')
            ->join('projects', 'translations.project_id', '=',
             'projects.id')
            ->where('projects.id', $this->id);
    }
}

