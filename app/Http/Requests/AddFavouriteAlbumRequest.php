<?php

namespace App\Http\Requests;

use App\Traits\AlbumTrait;
use Illuminate\Foundation\Http\FormRequest;

class AddFavouriteAlbumRequest extends FormRequest
{
    use AlbumTrait;

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
        [$album, $artist] = $this->getAlbumAndArtistFromId($this->id);
        $this->merge([
            'album' => $album,
            'artist' => $artist,
        ]);
    }
}
