<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreLabelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:labels',
            'description' =>'max:1500'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это обязательное поле',
            'name.unique' => 'Метка с таким именем уже существует',
            'description.max' => 'слишком много текста'
        ];
    }
}
