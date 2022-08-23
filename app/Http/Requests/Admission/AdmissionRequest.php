<?php

namespace App\Http\Requests\Admission;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionRequest extends FormRequest
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
        $rules = [
            'student_id'=>'required',
            'country_id' => 'required|',
            'state_id' => 'required|',
            'college_id' => 'required|',
            'fees' => 'required|',
            'intake_year' => 'required|',
            'intake_month' => 'required|',
        ];

        return $rules;
    }

    public function data()
    {
        $data = [
            'student_id' => $this->get('student_id'),
            'college_id'  => $this->get('college_id'),
            'fees'  => $this->get('fees'),
            'country_id'  => $this->get('country_id'),
            'state_id'  => $this->get('state_id'),
            'intake_year'  => $this->get('intake_year'),
            'intake_month'  => $this->get('intake_month'),
        ];

        return $data;

    }
}
