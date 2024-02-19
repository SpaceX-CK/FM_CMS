<?php

namespace App\Http\Requests;

use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
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
            'title' => [
                'string','max:255'
            ],
         
            'banner_desktop' => [
                'image',
                'sometimes',
                'mimes:' . implode(',', Media::supportedImageExtensions())
            ],
            'banner_mobile' => [
                'image',
                'sometimes',
                'mimes:' . implode(',', Media::supportedImageExtensions())
            ],
            'recommend' => [
                'nullable', 'array'
            ],
        ];
    }
}
