<?php

namespace App\Http\Requests\Pattern;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'theme'      => ['required', 'string', 'min:1'],
            'tag'        => ['required', 'string', 'min:1'],
            'viber_text' => ['required', 'string', 'min:3'],
            'sms_text'   => ['required', 'string', 'min:3'],
            'is_active'  => ['required'],
        ];
    }
}
