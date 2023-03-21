<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddFavouriteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'album' => ['required', 'string'],
            'artist' => ['required', 'string'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $albumInfo = explode('|', $this->id);
        $this->merge([
            'album' => $albumInfo[0],
            'artist' => $albumInfo[1],
        ]);
    }
}
