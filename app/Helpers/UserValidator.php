<?php
/**
 * Created by PhpStorm.
 * User: christopher
 * Date: 1/27/2018
 * Time: 6:26 PM
 */
namespace App\Helpers;

class UserValidator extends BaseValidator
{
    private $rules = [];
    private $messages = [];

    public function validateRegister($data)
    {
        $this->rules = [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'full_name' => 'required|string',
            'birthdate' => 'required|date'
        ];

        $this->messages = [
            'email.required' => 'The email is required.',
            'email.email' => 'The email format is invalid',
            'email.unique' => 'This email is already registered',
            'password.required' => 'The password is required',
            'password.confirmed' => 'The password and its confirmation don\'t match',
            'password.min' => 'The password must be at leat :min characters long',
            'full_name.required' => 'The name is required',
            'birthdate.required' => 'The birthdate is required',
            'birthdate.date' => 'The date format is not valid',
        ];

        return $this->dataValidator($data, $this->rules, $this->messages);
    }

    public function validateLogin($data)
    {
        $this->rules = [
            'email' => 'required|email',
            'password' => 'required|string',
        ];

        $this->messages = [
            'email.required' => 'The email is required.',
            'email.email' => 'The email format is invalid',
            'password.required' => 'The password is required',
        ];

        return $this->dataValidator($data, $this->rules, $this->messages);
    }

    public function validateUpdate($data)
    {
        $this->rules = [
            'full_name' => 'required|string',
            'birthdate' => 'required|date',
        ];

        $this->messages = [
            'full_name.required' => 'The name is required.',
            'birthdate.required' => 'The date of birth is required.',
            'birthdate.date' => 'The date format is not valid',
        ];

        return $this->dataValidator($data, $this->rules, $this->messages);
    }

}