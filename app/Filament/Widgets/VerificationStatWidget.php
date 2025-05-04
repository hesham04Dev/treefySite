<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VerificationStatWidget extends ChartWidget
{
    protected static ?string $heading = 'Weekly Verifications';

    protected function getData(): array
    {
        // Get verifications grouped by week for the last 6 weeks
        $verifications = DB::table('verifications')
            ->selectRaw("YEARWEEK(created_at, 1) as yearweek, COUNT(*) as count")
            ->where('created_at', '>=', Carbon::now()->subWeeks(5)->startOfWeek())
            ->groupBy('yearweek')
            ->orderBy('yearweek')
            ->get()
            ->keyBy('yearweek');

        $labels = [];
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $label = $startOfWeek->format('M d'); // e.g., "Apr 01"
            $yearweek = $startOfWeek->format('oW'); // ISO year and week number

            $labels[] = $label;
            $data[] = $verifications[$yearweek]->count ?? 0;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Verifications',
                    'data' => $data,
                    // 'backgroundColor' => '#60a5fa', // Optional: blue bars
                    'borderRadius' => 10, 
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
