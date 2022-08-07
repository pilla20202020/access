<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
            'name'=>'required'        ];

        return $rules;
    }

    public function data(){

        $inputs=[
            'name' => $this->get('name'),
            'alias'   => $this->get('alias'),
            'details'   => $this->get('details'),
            'starts'   => $this->get('starts'),
            'ends'   => $this->get('ends'),
            'success_message'   => $this->get('success_message'),
            'sms_message'   => $this->get('sms_message'),
            'coupon_codes'   => $this->get('coupon_codes'),
            'url'   => $this->get('url'),
            'keywords'   => $this->get('keywords'),
            'description'   => $this->get('description'),
            'status' => ($this->get('status') ? $this->get('status') : '') == 'on' ? 'active' : 'in-active',
            'created_by'   => Auth()->user()->id,

        ];

        if ($this->has('status')) {
            $inputs['status'] = "active";
        }

        return $inputs;
    }
}
