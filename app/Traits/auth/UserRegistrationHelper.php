<?php

namespace App\Traits\auth;

use App\Classes\enums\RoleEnum;
use App\Role;
use Illuminate\Support\Facades\Validator;

trait UserRegistrationHelper
{
    protected function loadRolesToFill()
    {
        return Role::whereIn('name', RoleEnum::getAssignableRoles())->get();
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|exists:roles,id',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return array
     */
    protected function getUserData(array $data)
    {
        return [
            'name' => $data['name'],
            'surname' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ];
    }
}