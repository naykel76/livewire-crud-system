<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Naykel\Gotime\Traits\Formable;

///////////////////////////////////////////////////////////
//               DO NOT REFACTOR THIS FILE               //
//  ---------------------------------------------------  //
//            FOR DEMONSTRATION PURPOSES ONLY            //
///////////////////////////////////////////////////////////

class UserForm extends Form
{
    use Formable;

    /**
     * The persisted model that is being edited.
     * 
     * It will only reflect the model state when it is first set, or after the form has
     * been saved. It will not reflect the model state after the form has been edited.
     * 
     * @var Model|null
     */
    public ?Model $editing;

    public string $email;
    public string $name;
    public string $email_verified_at;
    public string $password;
    public string $bio;
    public string $description;

    public function rules()
    {
        return [
            'email' =>  'required|string|email|max:255|unique:users,email,' . $this->editing->id,
            'name' => 'required|string|max:255',
            // add the `sometimes` rule to fields where default values are set
            // to make sure they are included in the validated data
            'email_verified_at' => 'sometimes',
            'password' => 'sometimes',
            'bio' => 'sometimes',
            'description' => 'sometimes',
        ];
    }

    public function init(User $user): void
    {
        $this->editing = $user;
        $this->setFormProperties($this->editing);
    }

    public function save(): Model
    {
        // The validated data will only contain the properties that have been
        // defined in the form class with a validation rule.

        // This is why we need to include public properties for any field where
        // you want to display a value in the form. For example, admin can see
        // the email_verified_at date field but it is not editable.
        $validatedData = $this->validate();

        
        // update or create the model with the validated data, then reassigning
        // `$this->editing` with the result of the updateOrCreate method is to
        // ensure that the $this->editing variable reflects the most current
        // state of the model as it exists in the database after the operation.
        $this->editing = $this->editing::updateOrCreate(['id' => $this->editing->id], $validatedData);

        // I am not sure if this is either necessary or a good idea.
        return $this->editing;
    }
}
