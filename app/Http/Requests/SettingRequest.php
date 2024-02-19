<?php

namespace App\Http\Requests;

use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'facebook' => [
                'string','nullable'
            ],
            'instagram'=> [
                'string','nullable'
            ],
            'logo_image' => [
                'image',
                'sometimes',
                'mimes:' . implode(',', Media::supportedImageExtensions())
            ],
        ];
    }
}
