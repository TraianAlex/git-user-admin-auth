<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SendMessageRequest extends Request
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
            'email' => 'required|email',
            'name' => 'required|max:100',
            'subject' => 'required|max:140',
            'message' => 'required|min:10'
        ];
    }
}
