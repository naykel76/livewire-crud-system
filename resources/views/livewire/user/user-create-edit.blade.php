<div class="container-md">
    <div class="my flex va-c space-between">
        <div>
            <x-gt-button.primary wire:click="save('save_close')" text="save & close" />
        </div>
    </div>
    <form wire:submit="save">
        <div class="flex gap-2">
            <div class="pr-2 fg1">
                <div class="grid md:cols-2">
                    <x-gt-input wire:model="form.name" for="form.name" label="name" autocomplete="Name" />
                    <x-gt-input wire:model="form.email" for="form.email" label="email" autocomplete="Email" />
                    <x-gt-input wire:model="form.email_verified_at" for="form.email_verified_at" label="Verified" disabled />
                    <x-gt-input wire:model="form.password" for="form.password" label="password" type="password" disabled />
                </div>
            </div>
        </div>
    </form>
</div>
