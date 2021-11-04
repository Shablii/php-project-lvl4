<?php

namespace App\Http\Requests;

use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
        $usersId = User::all()->pluck('id')->toArray();
        $usersId[] = '';
        $labelsId = Label::all()->pluck('id')->toArray();
        return [
            'name' => 'required|unique:tasks,name,' . $this->task,
            'status_id' => 'required',
            'assigned_to_id' => Rule::in($usersId),
            'description' => 'max:1500',
            'labels.*' => Rule::in($labelsId)
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это обязательное поле',
            'name.unique' => 'Задача с таким именем уже существует',
            'status_id.required' => 'Это обязательное поле',
        ];
    }
}
