<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractEditRequest extends FormRequest
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
            'enterprise_id',
            'type',
            'number' => 'required',
            'type_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            //'pdf' => 'required',
            //'datasheet' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'number.required' => 'Introdusca el numero de contrato por favor',
            'type_id.required' => 'Introdusca el tipo de contrato por favor',
            'start_date.required' => 'Introdusca la fecha de inicio por favor',
            'end_date.required' => 'Introdusca  la fecha final por favor',
            'pdf.required' => 'Introdusca el el sacan del contrato por favor',
            'datasheet.required' => 'Introdusca la ficha tecnica por favor'
        ];
    }
}
