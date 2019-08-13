<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $validate = [];

        if ($request->route()->named('users.store')) {
            $validate = [
                'name' => 'required|string',
                'login_id' => 'required|max:20|regex:/^[a-zA-Z0-9]+$/|unique:users,login_id,'.$this->route()->parameter('user'),
                'password' => 'required|max:20|regex:/^[a-zA-Z0-9]+$/',
            ];
        } elseif ($request->route()->named('users.update')) {
            $validate = [
                'login_id' => 'max:20|regex:/^[a-zA-Z0-9]+$/|unique:users,login_id,'.$this->route()->parameter('user'),
                'password' => 'max:20|regex:/^[a-zA-Z0-9]+$/',
            ];
        } elseif ($request->route()->named('users.checkPass')) {
            $validate = [
                'password' => 'required',
            ];
        }

        return $validate;
    }

    public function messages()
    {
        return [
            '*.regex' => ':attributeには半角英数字のみからなる文字列を指定してください。',
        ];
    }
}
