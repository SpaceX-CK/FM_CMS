<?php

namespace App\Http\Requests;

use App\Models\Shop;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'shop_name' => [
                'required', 'string', 'max:255', 
                Rule::unique(Shop::class, 'shop_name')
                    ->ignore($this->route('shop'), 'id')
                    ->whereNull('deleted_at')
            ],
        ];
    }
}
