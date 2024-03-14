<?php

namespace App\Http\Requests\Animes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class CreateAnimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'publisher' => 'required|string|max:255',
            'thumbnail' => 'sometimes|image|mimes:jpg,png,jpeg,gif|max:10240', 
            'type' => 'required|string|max:255',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
      throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}