<div>
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
