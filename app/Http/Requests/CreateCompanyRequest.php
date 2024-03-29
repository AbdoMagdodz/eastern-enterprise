<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|unique:companies,symbol|max:10',
            'description' => 'required|string',
            'street' => 'required|string|max:15',
            'phone_number' => 'required|string',
            'postal_code' => 'required|string|max:15',
            'country' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
