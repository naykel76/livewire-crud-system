<div>
    <div class="flex space-between va-c">
        <h1>{{ $pageTitle }}</h1>
        <div>
            <a class="btn primary disabled">
                <x-gt-icon name="plus-circle" class="icon" />
                <span>Add User (Via Modal)</span>
            </a>
            <a class="btn secondary" href="{{ route("$routePrefix.create") }}">
                <x-gt-icon name="plus-circle" class="icon" />
                <span>Add User (Via Route)</span>
            </a>
        </div>
    </div>

    <x-gtl-search-input placeholder="Search by name or email..." class="maxw-sm" />

    <table>
        <thead>
            <tr>
                <x-gt-table.th wire:click="sortBy('id')" sortable class="pr-3" :direction="$this->getSortDirection('id')"> UID </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('name')" sortable :direction="$this->getSortDirection('name')"> Name </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('email')" sortable :direction="$this->getSortDirection('email')"> Email </x-gt-table.th>
                <x-gt-table.th class="tac w-200"></x-gt-table.th>
            </tr>
        </thead>
        <tbody wire:loading.class="opacity-05" class="divide-y">
            @forelse($items as $user)
                <tr>
                    <td>{{ str_pad($user->id, 5, 0, STR_PAD_LEFT) }}</td>
                    <td class="whitespace-nowrap pr-3">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="tar">
                        <div class="flex justify-end space-x-05">
                            <x-gt-button wire:click="edit" text="SPA" icon="pencil-square" class="sm primary pxy-05 disabled" />
                            <a href="{{ route("$routePrefix.edit", $user->id) }}" class="btn sm secondary">
                                <x-gt-icon name="pencil-square" class="icon opacity-05" />
                                <span>Route</span>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="tac pxy txt-lg" colspan="6">No records found...</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $items->links('gotime::pagination.livewire') }}
</div>
