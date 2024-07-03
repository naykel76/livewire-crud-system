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
     * Saves using the form's save method and dispatches a notification event.
     * 
     * @param string|null $action Optional redirect action. save_close, etc.
     * @return void 
     */
    public function save(string $action = null): void
    {
        $this->form->save();

        // this event fires too quick when redirecting!
        $this->dispatch('notify', 'User saved successfully');

        // this will not do anything if there is no action
        $this->handleRedirect($action);
    }

    /**
     * Handles the redirect action after saving the form.
     * 
     * @param string $action The redirect action to handle.
     */
    public function handleRedirect($action)
    {
        switch ($action) {
            case 'save_close':
                return redirect(route("$this->routePrefix.index"));
                break;
        }
    }

    public function render()
    {
        return view($this->view)
            ->layout('components.layouts.app', [
                'pageTitle' => $this->pageTitle,
            ]);
    }
}
