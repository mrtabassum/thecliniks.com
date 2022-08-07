<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Service;

class CreateServicesRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Service::$rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'category_id.required' => 'The category field is required.',
            'doctors.required' => 'The doctor field is required.',
            'short_description.required' => 'The short description field is required.',
        ];
    }
}
