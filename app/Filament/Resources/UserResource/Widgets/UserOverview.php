<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Filament\Resources\UserResource\Pages\ListUsers;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserOverview extends BaseWidget
{

    use InteractsWithPageTable;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Admins', $this->getPageTableQuery()->where('role','ADMIN')->count()),
            Stat::make('Total Editors', $this->getPageTableQuery()->where('role','EDITOR')->count()),
            Stat::make('Total Users', $this->getPageTableQuery()->where('role','USER')->count()),
        ];
    }

    protected function getTablePage(): string
    {
        return ListUsers::class;
    }

}
