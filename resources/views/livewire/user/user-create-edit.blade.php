<div class="container-md">
    <div class="my flex va-c space-between">
        <div>
            <x-gt-button wire:click="save" text="save" class="success" />
            <x-gt-button wire:click="save('save_close')" text="save & close" class="pink" />
            <x-gt-button wire:click="save('save_stay')" text="save & stay" class="primary" />
        </div>
    </div>
    <form wire:submit="save">
        <div class="grid md:cols-2">
            <x-gt-input wire:model="form.name" for="form.name" label="name" autocomplete="Name" />
            <x-gt-input wire:model="form.email" for="form.email" label="email" autocomplete="Email" />
            <x-gt-input wire:model="form.email_verified_at" for="form.email_verified_at" label="Verified" disabled />
            <x-gt-input wire:model="form.password" for="form.password" label="password" type="password" disabled />
        </div>

        <x-gt-ckeditor wire:model="form.bio" label="Bio" editor-id="{{ '_' . rand() }}" />
        <x-gt-ckeditor.inline wire:model="form.description" label="description" editor-id="{{ '_' . rand() }}" />
    </form>
</div>
