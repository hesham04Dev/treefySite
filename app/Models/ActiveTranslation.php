<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class ActiveTranslation extends Model
{
    //

    public static function isActive($userId,$translationId){
        $activeTranslation = ActiveTranslation::where('translator_id', $userId)
            ->where('translation_id', $translationId)
            ->whereRaw('locked_at >= NOW() - INTERVAL 30 MINUTE')
            ->first();

        return $activeTranslation ? true : false;
    }
    public static function getReservedPoints($user_id)
    {
        $reservedPoints = DB::table('active_translations')
            ->join('translations', 'active_translations.translation_id', '=', 'translations.id')
            ->join('projects', 'translations.project_id', '=', 'projects.id')
            ->join('users', 'projects.user_id', '=', 'users.id')
            ->whereRaw('locked_at >= NOW() - INTERVAL 30 MINUTE')
            ->where('users.id', $user_id)
            ->selectRaw('SUM(projects.points_per_word) as reservedPoints')
            ->value('reservedPoints');  
    
        return $reservedPoints ?? 0;
    }
    
}
