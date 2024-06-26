<?php

namespace App\Http\Requests;

use App\Models\Bicycle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BicycleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'picture' => ['image', 'mimes:jpeg,jpg,png', 'max:2000', 'nullable'],
            'qr_code' => ['image', 'mimes:jpeg,jpg,png', 'max:2000', 'nullable'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['string', 'max:255'],
            'serial_number' => ['nullable', 'string', 'max:255'],
            'ref_number' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date', 'max:255'],
            'end_date' => ['nullable', 'date', 'max:255'],
            'recipient' => ['nullable', 'string', 'max:255'],
            'delivery_date' => ['nullable', 'date', 'max:255'],
            'delivery_location' => ['nullable', 'string', 'max:255'],
            'delivery_status' => ['nullable', 'boolean'],
            'repairs' => ['array', 'exists:repairs,id', 'nullable'],
            'location' => ['exists:locations,id', 'nullable'],
        ];
    }

}
