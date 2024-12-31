<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class User extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:6',
            'age' => 'required|numeric|min:18',
            'city' => 'required',
            'phone' => 'required|size:10'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'User Name is required!',
    //         'email.required' => 'User Email Address is required!',
    //         'email.email' => 'Enter correct Email Address!',
    //         'password.required' => 'User Password is required!',
    //         'password.min' => 'Password is minimum 6 characters!',
    //         'age.required' => 'User Age is required!',
    //         'age.numeric' => 'User Age is must be numeric!',
    //         'age.min' => 'User Minimum Age is 18!',
    //         'city.required' => 'User City is required!',
    //         'phone.required' => 'User Phone No. is required!',
    //         'phone.size' => 'Phone No. must be 10 digit!',
    //     ];
    // }

    // public function attributes()
    // {
    //     return [
                // This method use in the laravel inbuilt msg is same but the attributes are changed
    //         'name' => 'User Name',
    //         'email' => 'Usee Email Address',
    //     ];
    // }

    protected function prepareForValidation(): void
    {
        $this->merge([
            // in name field string convert to uppercase
            // 'name' => strtolower($this->name),

            // in name field string the name is (bhargav khandar) this convert in (bhargav-khandar)
            'name' => Str::slug($this->name),
        ]);
    }

    // error stop in one line
    // protected $stopOnFirstFailure = true;
}
