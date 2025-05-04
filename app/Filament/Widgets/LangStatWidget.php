<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class LangStatWidget extends ChartWidget
{
    protected static ?string $heading = 'Top Languages by Translator Count';
    protected static ?int $sort = 2; // optional sort position
    // protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $results = DB::table('languages')
            ->join('language_translator', 'languages.id', '=', 'language_translator.language_id')
            ->select('languages.name', DB::raw('COUNT(language_translator.translator_id) as count'))
            ->groupBy('languages.name')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Translators',
                    'data' => $results->pluck('count'),
                    // 'backgroundColor' => 'rgba(59, 130, 246, 0.7)', // blue
                    'borderRadius' => 10, 
                ],
            ],
            'labels' => $results->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
