<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class UserStatsWidget extends BaseWidget
{

    public ?User $record;

    protected function getStats(): array
    {
        return [
            Stat::make('Num Posts', $this->record->posts()->count()),
            Stat::make('Num Comments', $this->record->comments()->count()),
        ];
    }
}
