<?php

namespace App\Livewire;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            
            Column::make("Id", "id")
                ->sortable()->selectedIf('id'),
            Column::make("Username", "username")
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
                ->sortable()
                ->searchable(),
            Column::make("Updated at", "updated_at")
                ->sortable()
                ->searchable(),
            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $delete = '<button class="text-red-500 hover:underline m-1" wire:click="delete(' . $row->id . ')">Delete</button>';
                        return $delete;
                    }
                )->html(),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Export Excel',
            'delete' => 'Delete All',
        ];
    }

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        return;
    }

    public function delete()
    {
        return view("components/modal", []);
    }
}
