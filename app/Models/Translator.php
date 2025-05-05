<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Translator.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
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
        return $this->belongsTo(User::class, );
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_translator', 'translator_id', 'language_id');
    }

    public function enrolledProjects()
    {
        return $this->belongsToMany(Project::class, 'project_translator', 'translator_id', 'project_id');
    }

    public function isEnrolled($projectId)
    {
        return $this->enrolledProjects()->where('project_id', $projectId)->exists();
    }


    public function languageRequests()
    {
        return $this->hasMany(LanguageRequest::class, 'translator_id', 'user_id');
    }


public function getTranslationsForVerify($withSelect=true)
{
    $translatorId = auth()->id();

    $query = DB::table('translation_keys as tk')
    ->join('translations as t', 't.key_id', '=', 'tk.id')
    ->join('projects as p', 't.project_id', '=', 'p.id')
    ->join('languages as l', 'l.id', '=', 't.language_id')
    ->join('users as u', 'u.id', '=', 'p.user_id')
    ->leftJoin('verifications as v', 'v.translation_id', '=', 't.id')
    ->join('project_translator as pt', function ($join) {
        $join->on('pt.project_id', '=', 'p.id')
             ->where('pt.translator_id', '=', $this->user_id);
    })
    ->where('u.is_banned', 0)
    ->where('t.skipped', 0);


    $this->applyActiveProjectsFilter($query);
    $this->applyPointsPerWordFilter($query);
    $this->excludeAlreadyVerifiedTranslations($query, $translatorId);
    $this->includeTranslatorLanguagesOnly($query, $translatorId);
    $this->excludeActivelyLockedTranslations($query, $translatorId);
    if($withSelect) {
        $this->selectTranslationColumns($query);
        
    }
    $this->groupTranslationResults($query);
    $this->filterByNeededVerifications($query);

    return $query;
}

public function getProjectsForVerify(){

}

private function applyActiveProjectsFilter($query)
{
    $query->where('p.is_disabled', 0);
}

private function applyPointsPerWordFilter($query)
{
    // note this before showing translation there are another check when load current translation
    $query->whereRaw('(p.points_per_word = 0 OR u.points > 0)');

    // $query->where(function($q) {
    //     $q->where('p.points_per_word', 0)
    //       ->orWhereRaw('
    //           (
    //               u.points - (
    //                   SELECT IFNULL(SUM(p2.points_per_word), 0)
    //                   FROM active_translations at2
    //                   INNER JOIN translations t2 ON t2.id = at2.translation_id
    //                   INNER JOIN projects p2 ON p2.id = t2.project_id
    //                   WHERE p2.user_id = u.id
    //                     AND at2.locked_at >= NOW() - INTERVAL 30 MINUTE
    //               )
    //           ) >= p.points_per_word
    //       ');
    // });
   
}

private function excludeAlreadyVerifiedTranslations($query, $translatorId)
{
    $query->whereNotExists(function ($subQuery) use ($translatorId) {
        $subQuery->select(DB::raw(1))
            ->from('verifications')
            ->whereColumn('verifications.translation_id', 't.id')
            ->where('verifications.translator_id', $translatorId);
    });
}

private function includeTranslatorLanguagesOnly($query, $translatorId)
{
    $query->whereIn('t.language_id', function ($subQuery) use ($translatorId) {
        $subQuery->select('language_id')
            ->from('language_translator')
            ->where('translator_id', $translatorId);
    });
}

private function excludeActivelyLockedTranslations($query, $translatorId)
{
    $query->whereRaw("
        (
            SELECT COUNT(*)
            FROM active_translations at
            WHERE at.translation_id = t.id
              AND at.translator_id != ?
              AND at.locked_at >= NOW() - INTERVAL 30 MINUTE
        ) < p.verification_no
    ", [$translatorId]);
}

private function selectTranslationColumns($query)
{
    $query->select(
        'p.id as project_id',
        'tk.value as key',
        't.id as id',
        't.value as value',
        'l.name as language',
        'p.verification_no'
    );
}

private function groupTranslationResults($query)
{
    $query->groupBy(
        // 'p.*',
        't.id',
        'tk.id',
        'tk.value',
        'p.id',
        'p.verification_no',
        'l.name',
        't.value'
    );
}

private function filterByNeededVerifications($query)
{
    $query->havingRaw('COUNT(v.id) < p.verification_no');
}



    public function getLevelPercentage()
    {
        $level = $this->level;
        $exp = $this->exp;

        $baseExp = 1000;

        $maxExp = $level * $baseExp;

        return round(($exp / $maxExp) * 100);

    }

}

