<?php

namespace App\Http\Requests;

use App\Models\Repair;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RepairRequest extends FormRequest
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
            'type' => ['required', 'string', 'max:255', Rule::unique(Repair::class)],
            'slug' => ['string', 'max:255'],
        ];
    }
}
