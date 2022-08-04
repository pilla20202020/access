<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class CustomerRequest extends FormRequest
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
            'name'=>'required'
        ];

        return $rules;
    }
    public function data(){
        
        
        $inputs=[
            'name' => $this->get('name'),
            'email'   => $this->get('email'),
            'password'   => Hash::make($this->get('password')),

        ];
      

        return $inputs;
    }
}
