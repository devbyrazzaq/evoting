<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class VoterCreateRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'voter_id' => Str::random(6),
            'username' => str_replace(' ', '-', strtolower($this->name)),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email', 'unique:voters'],
            'voter_id' => ['required'],
            'username' => ['required'],
        ];
    }
}
