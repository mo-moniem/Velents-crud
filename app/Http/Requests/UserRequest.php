<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
       if($this->method() === 'POST'){
           return $this->store();
       }else{
           return $this->update();
       }
    }

    private function store()
    {
        return [
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'photo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    private function update()
    {
        return [
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'photo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:users,email,' . $this->user,
            'password' => 'required|string|min:6',
        ];
    }
}
