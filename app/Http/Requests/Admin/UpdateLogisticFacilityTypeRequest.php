<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLogisticFacilityTypeRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('logistic_facility_types','name')->ignore($this->logistic_facility_type)
            ],
            'zoom' => 'nullable|integer',
            'parameters' => 'nullable|json',
            'icon'=>'nullable|mimes:jpg,jpeg,svg,png|max:6000'
        ];
    }

    //Request rules' neticesini manual controller metodunda yoxlamaq ucun lazim olan kod hisseciyi .
    public $validator = null;

    protected function failedValidation($validator)
    {
        $this->validator = $validator;
    }

}
