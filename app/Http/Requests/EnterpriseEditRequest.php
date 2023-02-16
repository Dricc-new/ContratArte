<?php

namespace App\Http\Requests;

use App\Models\Enterprise;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnterpriseEditRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'type' => 'required',
/*             'reeup' => 'unique:enterprises,reeup',*/
            'name' => 'required',
            'email' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'reeup.unique' => 'este codigo ya existe',
            'reeup.required' => 'Introdusca el codigo',
            'name.required' => 'Introdusca un nombre',
            'email.exists' => 'Introdusca un correo electronico ',
        ];
    }
}
