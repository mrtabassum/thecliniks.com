<?php

namespace App\Http\Requests;

use App\Models\Qualification;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\City;

class CreateQualificationRequest extends FormRequest
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
        return Qualification::$rules;
    }

    /**
     *
     * @return string[]
     */
    public function messages()
    {
        return [
            'degree.required' => 'Degree field is required.',
            'university.required' => 'University field is required.',
            'year.required' => 'Year field is required.',
        ];
    }
}
