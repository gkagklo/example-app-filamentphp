<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class TestWidget extends BaseWidget
{

    protected static ?int $sort = 1;

    use InteractsWithPageFilters;

    protected function getStats(): array
    {

        $start = $this->filters['startDate'] ?? null;
        $end = $this->filters['endDate'] ?? null;

        return [
            Stat::make('Users', 
            User::when($start,
            fn ($query) => $query->whereDate('created_at', '>', $start ))
            ->when($end,
            fn ($query) => $query->whereDate('created_at', '<', $end ))
            ->count())
            ->description('New users that have joined')
            ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
            Stat::make('Categories', Category::count())
            ->description('Categories count')
            ->descriptionIcon('heroicon-o-folder', IconPosition::Before)
            ->chart([17, 16, 14, 15, 14, 13, 12])
            ->color('danger'),
            Stat::make('Posts', Post::count())
            ->description('Posts count')
            ->descriptionIcon('heroicon-o-rectangle-stack', IconPosition::Before)
            ->chart([15, 4, 10, 2, 12, 4, 12])
            ->color('info'),
        ];
    }
}
