<?php

namespace App\Http\Requests\Business;

use App\Models\Business;
use Illuminate\Foundation\Http\FormRequest;

class BusinessUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', Business::findOrFail($this->route('id')));;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:businesses,id',
            'name' => 'required|string|min:4|max:64',
            'description' => 'required|string|min:8|max:512',
            'category_id' => 'required|integer|digits_between:0,10',
            'raiting' => 'required|integer|digits_between:0,100',
            'phone' => 'required|string|min:8|max:32',
            'email' => 'required|string|min:4:max:64',
            'website' => 'required|string|min:4:max:128'
        ];
    }
}