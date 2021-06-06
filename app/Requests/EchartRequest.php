<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EchartRequest extends FormRequest
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
        // TODO дописать реквест
        return [
//            'chart_type' => 'required|string',
//            'title' => 'required',
//            'x_axis_data' => 'required',
//            'column_name' => 'required',
        ];
    }
}
