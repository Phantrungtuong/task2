<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
            'name'=>'required|max:225',
            'email'=>'required|email|max:225',
            'gender'=>'required',
            'city'=>'required',
            'hobby'=>'required',
            'note'=>'max:500',

        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Bạn không được để trống trường này',
            'name.max'=>'Vượt quá ký tự quy định! tối đa 225 ký tự',
            'email.required'=>'Bạn không được để trống trường này',
            'email.email'=>'Không đúng định dạng Email',
            'email.max'=>'Vượt quá ký tự cố định! tối đa 225 ký tự',
            'gender.required'=>'Bạn không được để trống trường này',
            'city.required'=>'Bạn không được để trống trường này',
            'hobby.required'=>'Bạn không được để trống trường này',
            'note.required'=>'Bạn không được để trống trường này',
        ];
    }
}
