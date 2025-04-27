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


    // WIth multi edit at same time not tested
    public function getTranslationsForVerify()
    {
        $translatorId = auth()->id();

        return DB::table('translation_keys as tk')
            ->join('translations as t', 't.key_id', '=', 'tk.id')
            ->join('projects as p', 't.project_id', '=', 'p.id')
            ->join('languages as l', 'l.id', '=', 't.language_id')
            ->leftJoin('verifications as v', 'v.translation_id', '=', 't.id')

            // ❌ Exclude translations already verified by this translator
            ->whereNotExists(function ($query) use ($translatorId) {
                $query->select(DB::raw(1))
                    ->from('verifications')
                    ->whereColumn('verifications.translation_id', 't.id')
                    ->where('verifications.translator_id', $translatorId);
            })

            // ✅ Include only translations in the languages the translator knows
            ->whereIn('t.language_id', function ($query) use ($translatorId) {
                $query->select('language_id')
                    ->from('language_translator')
                    ->where('translator_id', $translatorId);
            })

            // ❌ Already being actively verified by another translator
            ->whereRaw("
    (
        (
            SELECT COUNT(*)
            FROM active_translations at
            WHERE at.translation_id = t.id
              AND at.translator_id != ?
              AND at.locked_at >= NOW() - INTERVAL 30 MINUTE
        ) < p.verification_no
        
    )
", [$translatorId])


            // ✅ Select needed columns
            ->select(
                'p.id as project_id',
                'tk.value as key',
                't.id as id',
                't.value as value',
                'l.name as language',
                'p.verification_no',
                // 't.active_translators'
            )

            // ✅ Group by necessary columns
            ->groupBy(
                't.id',
                'tk.id',
                'tk.value',
                'p.id',
                'p.verification_no',
                'l.name',
                't.value'
            )

            // ✅ Only show translations needing more verifications
            ->havingRaw('COUNT(v.id) < p.verification_no');
    }


    // public function getTranslationsForVerify()
    // {
    //     $translatorId = auth()->id();

    //     return DB::table('translation_keys as tk')
    //         ->join('translations as t', 't.key_id', '=', 'tk.id')
    //         ->join('projects as p', 't.project_id', '=', 'p.id')
    //         ->join('languages as l', 'l.id', '=', 't.language_id')
    //         ->leftJoin('verifications as v', 'v.translation_id', '=', 't.id')

    //         // ❌ Exclude translations already verified by this translator
    //         ->whereNotExists(function ($query) use ($translatorId) {
    //             $query->select(DB::raw(1))
    //                 ->from('verifications')
    //                 ->whereColumn('verifications.translation_id', 't.id')
    //                 ->where('verifications.translator_id', $translatorId);
    //         })

    //         // ✅ Include only translations in the languages the translator knows
    //         ->whereIn('t.language_id', function ($query) use ($translatorId) {
    //             $query->select('language_id')
    //                 ->from('language_translator')
    //                 ->where('translator_id', $translatorId);
    //         })

    //         // ❌ Already being actively verified by another translator
    //         ->whereRaw("
    //         (
    //             SELECT COUNT(*)
    //             FROM active_translations
    //             WHERE active_translations.translation_id = t.id
    //             AND active_translations.translator_id != ?
    //             AND active_translations.created_at >= NOW() - INTERVAL 2 MINUTE
    //         ) < p.verification_no
    //     ", [$translatorId])

    //         // ✅ Select needed columns
    //         ->select(
    //             'p.id as project_id',
    //             'tk.value as `key`',
    //             't.id as translation_id',
    //             't.value as translation',
    //             'l.name as lang',
    //             'p.verification_no',
    //             't.active_translators'
    //         )

    //         // ✅ Group by necessary columns
    //         ->groupBy(
    //             't.id',
    //             'tk.id',
    //             'tk.value',
    //             'p.id',
    //             'p.verification_no',
    //             't.active_translators',
    //             'l.name',
    //             't.value'
    //         )

    //         // ✅ Only show translations needing more verifications
    //         ->havingRaw('COUNT(v.id) < (p.verification_no - t.active_translators)');
    // }

}

