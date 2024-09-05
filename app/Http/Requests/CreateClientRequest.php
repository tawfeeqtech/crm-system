<?php

namespace App\Http\Requests;

use App\Enums\StatusClients;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateClientRequest extends FormRequest
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
            'company' => 'required|string|max:255',
            'vat' => 'required|integer|digits:5',
            'address' => 'nullable|string',
            'status' => 'required|string|in:' . implode(',', StatusClients::values()),
        ];
    }
}
