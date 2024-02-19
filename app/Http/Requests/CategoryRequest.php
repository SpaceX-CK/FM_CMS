<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Media;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category_name' => [
                'required', 'string', 'max:255', 
                Rule::unique(Category::class, 'category_name')
                    ->ignore($this->route('category'), 'id')
                    ->whereNull('deleted_at')
            ],
            'category_description' => [
                'string','nullable'
            ],

            'category_image' => [
                'image',
                'sometimes',
                'mimes:' . implode(',', Media::supportedImageExtensions())
            ],
            'category_image_mobile' => [
                'image',
                'sometimes',
                'mimes:' . implode(',', Media::supportedImageExtensions())
            ],
            'sequence' => [
                'nullable', 'integer', 'min:0'
            ]
        ];
        // switch ($this->method()) {
        //     case 'PUT':
        //     case 'PATCH':
        //         $rules['category_name'] = 'required|string|max:255';
        //         break;
        // }
        return $rules;
    }
}
