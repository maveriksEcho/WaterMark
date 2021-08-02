<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'image' => 'required|file|mimes:jpeg,png'
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [];
    }
}
