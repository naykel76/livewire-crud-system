<x-gt-app-layout layout="{{ config('naykel.template') }}" hasContainer class="py-5-3-2-2">

    <h1>{{ $pageTitle ?? null }}</h1>

    <div class="bx">
        <livewire:user.user-table />
    </div>

</x-gt-app-layout>
