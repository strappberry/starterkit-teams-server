<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Form;

class UserForm extends Form
{
    public $id;

    public $name;

    public $email;

    public $password;

    public $role;

    public $permissions = [];

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'string'],
        ];

        if (! $this->id) {
            $rules['email'][] = 'unique:users';
            $rules['password'] = ['required', 'string', 'min:8'];
        }

        return $rules;
    }

    public function store(): User
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        $user = User::updateOrCreate(
            ['id' => $this->id],
            $data
        );

        $user->syncRoles([$this->role]);
        $user->syncPermissions($this->permissions);

        return $user;
    }
}
