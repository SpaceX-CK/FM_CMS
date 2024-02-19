<?php

namespace App\Http\Requests;

use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class ProductRequest extends FormRequest
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
        $rules = [
            'product_name' => [
                'required', 'string', 'max:255'
            ],
            'product_title' => [
                'string', 'max:255','nullable'
            ],
            
            'product_description' => [
                'string','nullable', 'max:6000' 
            ],
            'category_id' => [
                'required', 'integer'
            ],
            'product_image' => [
                'image',
                'sometimes',
                'mimes:' . implode(',', Media::supportedImageExtensions())
            ],
            'sequence' => [
                'nullable', 'integer', 'min:0'
            ],
            'recommend' => [
                'nullable', 'array'
            ],
            'product_size' => [
                'nullable', 'array' 
            ],
            'product_content.*' => [
                'nullable', 
                'mimes:' . implode(',', Media::supportedImageExtensions())
            ],
            'product_content_mobile.*' => [
                'nullable', 
                'mimes:' . implode(',', Media::supportedImageExtensions())
            ],
            // 'order_column' => [
            //     'nullable', 'integer', 'min:1'
            // ],
            'shop_list' => [
                'nullable', 'array'
            ],
            'shop_url' => [
                'nullable', 'array'
            ],
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'category_id.required' => 'The category is required.',
        ];
    }
}
