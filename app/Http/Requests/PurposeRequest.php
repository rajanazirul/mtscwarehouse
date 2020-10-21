<?php

namespace App\Http\Requests;

use App\Purpose;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PurposeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'purposename' => [
                'required', 'min:3'
            ],

           
           

        ];
    }
}
