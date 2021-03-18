<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSeasonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // @todo check if user owns season
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
            'year' => 'required|numeric'
        ];
    }
}
