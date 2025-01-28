<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . ($userId ? $userId->id : null),
            'password' => 'required_if:password,!=,null|min:6'
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Nome é obrigatório!',
            'email.required' => 'E-mail é obrigatório!',
            'email.email' => 'Informe um e-mail válido!',
            'email.unique' => 'E-mail já cadastrado!',
            'password.required_if' => 'Senha é obrigatória!',
            'password.min' => 'Senha deve ter no mínimo :min caracteres!',
        ];
    }
}
