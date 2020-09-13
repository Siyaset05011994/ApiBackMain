<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLayerRequest extends FormRequest
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
                Rule::unique('layers','name')->ignore($this->layer)
            ],
            'logistic_facility_types_id' =>'required|exists:logistic_facility_types,id'
        ];
    }

    //Request rules' neticesini manual controller metodunda yoxlamaq ucun lazim olan kod hisseciyi .
    public $validator = null;

    protected function failedValidation($validator)
    {
        $this->validator = $validator;
    }

}
