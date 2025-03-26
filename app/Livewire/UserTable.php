<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

class UserTable extends DataTableComponent
{
    protected $model = User::class;
    public $userIdBeingDeleted = null;
    public $showDeleteModal = false;
    public $name = null;
    public $notification = null;
    public $notificationType = 'success'; // success or error

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
        $this->setComponentWrapperAttributes([
            'class' => '',
        ]);
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
            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $delete = '<button class="text-red-500 hover:underline m-1" wire:click="confirmDelete(' . $row->user_id . ')">Delete</button>';
                        return $delete;
                    }
                )->html(),
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

    public function bulkActions(): array
    {
        return [
            'export' => 'Export Excel',
            'confirmBulkDelete' => 'Delete All',
        ];
    }

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        return;
    }

    public function confirmDelete($userId)
    {
        $this->name = $userId ? User::find($userId)->name : null;
        $this->userIdBeingDeleted = $userId;
        $this->showDeleteModal = true;
    }

    public function confirmBulkDelete()
    {
        if (count($this->getSelected()) === 0) {
            $this->showNotification('Please select at least one voter to delete.', 'error');
            return;
        }

        $this->showDeleteModal = true;
    }

    public function deleteUser()
    {
        DB::beginTransaction();
        
        try {
            if ($this->userIdBeingDeleted) {
                // Get user before deleting
                $user = User::where('user_id', $this->userIdBeingDeleted)->first();
                
                if ($user) {
                    $userName = $user->name;
                    
                    // Delete related votes first
                    Vote::where('user_id', $user->user_id)->delete();
                    
                    // If user is a candidate, handle candidate-related deletions
                    if ($user->isCandidate()) {
                        $candidate = $user->candidate;
                        // Delete votes for this candidate
                        Vote::where('candidate_id', $candidate->candidate_id)->delete();
                        // Delete candidate record
                        $candidate->delete();
                    }
                    
                    // Finally delete the user
                    $user->delete();
                    
                    // Show success message
                    $this->showNotification("Voter '{$userName}' has been successfully deleted.", 'success');
                }
            } else {
                // Count selected users
                $count = count($this->getSelected());
                $selectedIds = $this->getSelected();
                
                // For bulk deletion, handle each user individually
                foreach ($selectedIds as $userId) {
                    $user = User::find($userId);
                    
                    if ($user) {
                        // Delete related votes
                        Vote::where('user_id', $user->user_id)->delete();
                        
                        // If user is a candidate, handle candidate-related deletions
                        if ($user->isCandidate()) {
                            $candidate = $user->candidate;
                            // Delete votes for this candidate
                            Vote::where('candidate_id', $candidate->candidate_id)->delete();
                            // Delete candidate record
                            $candidate->delete();
                        }
                        
                        // Delete the user
                        $user->delete();
                    }
                }
                
                $this->clearSelected();
                
                // Show success message
                $this->showNotification("{$count} voters have been successfully deleted.", 'success');
            }
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            // Show error message
            $this->showNotification("Error deleting voter(s): " . $e->getMessage(), 'error');
        }
        
        // Reset variables and close modal
        $this->userIdBeingDeleted = null;
        $this->showDeleteModal = false;
    }

    public function showNotification($message, $type = 'success')
    {
        $this->notification = $message;
        $this->notificationType = $type;

        // Auto-hide notification after 5 seconds
        $this->dispatch('hideNotification');
    }

    public function cancelDelete()
    {
        $this->userIdBeingDeleted = null;
        $this->showDeleteModal = false;
    }

    // Override the view that wraps the data table
    public function customView(): string
    {
        return 'components.livewire.user-table';
    }
}