<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Visit;

class UpdateVisitRequest extends FormRequest
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
        $rules = Visit::$rules;

        return $rules;
    }

    /**
     *
     * @return string[]
     */
    public function messages()
    {
        return [
            'patient_id.required' => 'The Patient field is required',
            'doctor_id.required'  => 'The Doctor field is required',
        ];
    }
}
