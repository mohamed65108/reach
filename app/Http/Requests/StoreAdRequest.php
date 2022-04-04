<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
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
            'type' => ['required', 'in:free,paid'],
            'title' => ['required', 'string', 'unique:ads,title', 'min:1', 'max:255'],
            'description' => ['required', 'string', 'min:1', 'max:500'],
            'start_date' => ['required', 'dateformat:Y-m-d', 'after:yesterday'],
            'category_id' => ['required', 'exists:categories,id'],
            'advertiser_id' => ['required', 'exists:advertisers,id'],
            'tags' => ['required', 'array'],
            'tags.*' => ['required', 'exists:tags,id', 'distinct'],
        ];
    }
}
