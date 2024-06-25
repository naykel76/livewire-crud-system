<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Naykel\Gotime\Traits\Searchable;
use Naykel\Gotime\Traits\Sortable;

///////////////////////////////////////////////////////////////////////////////
//                         DO NOT REFACTOR THIS FILE                         //
//  -----------------------------------------------------------------------  //
//                   IT IS FOR DEMONSTRATION PURPOSES ONLY                   //
///////////////////////////////////////////////////////////////////////////////

class UserTable extends Component
{
    use WithPagination, Searchable, Sortable;

    private string $modelClass  = User::class;
    public string $pageTitle = 'User Table';
    public string $routePrefix = 'users';
    public string $view = 'livewire.user.user-table';

    public array $searchableFields = ['name', 'email'];

    protected function prepareData()
    {
        $query = $this->modelClass::query();
        $query = $this->applySorting($query);
        $query = $this->applySearch($query);
        return ['items' => $query->paginate(20)];
    }

    public function render()
    {
        return view($this->view, $this->prepareData())
            ->layout('components.layouts.app', [
                'pageTitle' => $this->pageTitle,
            ]);
    }
}
