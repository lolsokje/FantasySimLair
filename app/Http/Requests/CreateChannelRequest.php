<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChannelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'channel_id' => 'required|numeric|unique:users,provider_id'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'channel_id.unique' => "A channel with the provided ID already exists"
        ];
    }
}
