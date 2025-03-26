<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

class DashboardAdminUserTable extends DataTableComponent
{
    protected $model = User::class;

    public function builder(): Builder
    {
        return User::query()
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            });
    }

    public function configure(): void
    {
        $this->setPrimaryKey('user_id');
        $this->setEagerLoadAllRelationsEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "user_id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("NIM", "nim")
                ->sortable()
                ->searchable(),
            Column::make("Status", "status")
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Status')
                ->options([
                    'Belum' => 'Belum',
                    'Sudah' => 'Sudah',
                ])->filter(function (Builder $builder, array $values) {
                    $builder->whereIn('status', $values);
                }),
        ];
    }
}