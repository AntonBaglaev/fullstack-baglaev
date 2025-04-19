<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;


class ForgotPasswordFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['email' => "string[]", 'password' => "string[]"])] public function rules(): array
    {
        return [
            'email' => ['required', 'email:dns'],
        ];
    }
}
