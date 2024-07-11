<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

///////////////////////////////////////////////////////////
//               DO NOT REFACTOR THIS FILE               //
//  ---------------------------------------------------  //
//            FOR DEMONSTRATION PURPOSES ONLY            //
///////////////////////////////////////////////////////////

class UserCreateEdit extends Component
{
    public UserForm $form;
    public string $pageTitle = 'Create/Edit User';
    public string $routePrefix = 'users';
    public string $view = 'livewire.user.user-create-edit';

    public function mount(User $user)
    {
        // $user = User::firstOrFail();
        $model = $user->exists ? $user : $this->initModel();
        $this->form->init($model);
    }

    public function initModel()
    {
        // This method initializes a new User model instance with default values
        // for the form fields. Note that Livewire 3 does not support automatic
        // model binding, so it cannot handle the serialization of model
        // instances directly. 

        // As a result, the default values are used to populate the form fields,
        // but changes to the form inputs must be manually synchronized with the
        // model attributes. This can be achieved by adding a validation rule to
        // ensure the field is included in the validated data before saving it.
        return User::make([
            'email' => fake()->unique()->safeEmail(), // For lazy testing
            'name' => fake()->name(),                 // For lazy testing
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(10)),
        ]);
    }

    /**
     * Saves using the form's save method and dispatch a notification event.
     * 
     * @param string|null $action Optional redirect action. save_close, etc.
     * @return void 
     */
    public function save(string $action = null): void
    {
        $model = $this->form->save();

        // this event fires too quick when redirecting!
        // NK::TD dispatch to a listener on the parent component
        $this->dispatch('notify', 'User saved successfully');

        if ($action) {
            $this->handleRedirect($this->routePrefix, $action, $model->id);
        }
    }

    /**
     * Handles redirection based on the provided action.
     *
     * @param string $routePrefix The prefix for the route.
     * @param string $action The action to be performed 'save_close', 'delete_close' ...
     * @param int $id The optional ID for routes that require it.
     * @return \Illuminate\Http\RedirectResponse Returns a redirect response based on the action.
     * @throws \Exception Throws an exception if an invalid action is provided.
     */
    function handleRedirect(string $routePrefix, string $action, int $id = null)
    {
        return match ($action) {
            'save_close', 'delete_close' => redirect(route("$this->routePrefix.index")),
            'save_new' => redirect(route("$routePrefix.create")),
            'save_edit', 'save_stay' => redirect(route("$routePrefix.edit", $id)),
            default => throw new \Exception("Invalid action: $action"),
        };
    }

    public function render()
    {
        return view($this->view)
            ->layout('components.layouts.app', [
                'pageTitle' => $this->pageTitle,
            ]);
    }
}
