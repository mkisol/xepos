<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'first_name' => 'required|string|min:2|max:50',
			'last_name' => 'required|string|min:2|max:50',
			'company' => 'required|exists:App\Models\Company,id',
			'email' => 'required|email|unique:employees,email,' . $this->employee->id,
			'phone' => 'required|numeric',
        ];
    }
}
