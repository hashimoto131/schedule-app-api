<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
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
     * [Override] バリデーション失敗時
     *
     * @param Validator $validator
     * @throw HttpResponseException
     *
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $errorMessage = null;
        foreach ($validator->errors()->toArray() as $colums) {
            foreach ($colums as $valid) {
                $errorMessage .= $valid. PHP_EOL;
            }
        }
        $errorMessage = rtrim($errorMessage, PHP_EOL);
        $response = [
            'data' => null,
            'error' => [
                'code' => 400,
                'message' => $errorMessage,
            ],
        ];

        logger($response);
        throw new HttpResponseException(
            response()->json($response, 400)
        );
    }
}
