<?php

namespace App\Http\Requests\V1\CurrikiGo;

use Illuminate\Foundation\Http\FormRequest;

class CreateAssignmentGroupRequest extends FormRequest
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
            'setting_id' => 'required',
            'assignment_group_name' => 'required|string|max:255'
        ];
    }
}
