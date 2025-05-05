<?php 

namespace App\Filament\Widgets;

use App\Models\Translator;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Project;
use App\Models\Verification;
use App\Models\Transaction;

class AdminStatsWidget extends StatsOverviewWidget
{
    // protected static ?string $heading = 'Admin Statistics';
    protected static bool $isLazy = false;

    protected function getCards(): array
    {
        $translatorCount = Translator::count();
        $acceptedTranslator = DB::table('translators')->where('is_accepted', 1)->count();

        return [
            Card::make('Total Users', User::count() - $translatorCount),

            Card::make('Accepted Translators', $acceptedTranslator),

            Card::make('pending Translators', $translatorCount - $acceptedTranslator),

            // Card::make('Verifications This Week', Verification::whereBetween('created_at', [
            //     now()->startOfWeek(),
            //     now()->endOfWeek()
            // ])->count()),

            // Card::make('Completed Projects', DB::table('project_translator')
            //     ->select('project_id')
            //     ->groupBy('project_id')
            //     ->havingRaw('COUNT(DISTINCT translator_id) >= ?', [DB::raw('projects.verification_no')]) // example logic
            //     ->count()),

            // Card::make('Pending Projects', Project::whereRaw(
            //     '(SELECT COUNT(*) FROM translations WHERE translations.project_id = projects.id) < verification_no'
            // )->count()),

            Card::make('Total Projects', Project::count()),
            Card::make('no of supported langs', DB::table('language_translator')->distinct('language_id')->count()),
            
            Card::make('Requested langs', DB::table('language_requests')->where('is_approved','0')->count()),

            // Card::make('Total Profit (Admin Points)', auth()->user()->points), 
        ];
    }
}
