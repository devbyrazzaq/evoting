<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoterUpdateRequest extends FormRequest
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
        // $rule_email = $this->route('voter')->email === $this->route('voter')->old_email ? ['required', 'email', 'unique:voters,email'] : ['required', 'email'];

        return [
            'name' => ['required', 'max:255', 'string'],
            // 'email' => $rule_email,
            'email' => ['required', 'email', Rule::unique('voters')->ignore($this->route('voter'))],
            'username' => ['required'],
        ];
    }
}
