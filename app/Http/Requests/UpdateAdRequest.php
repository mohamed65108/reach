<?php

namespace App\Http\Requests;

class UpdateAdRequest extends StoreAdRequest
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
            'title' => ['required', 'string', 'unique:ads,title,' . $this->ad->id, 'min:1', 'max:255'],
        ];
        return array_merge(parent::rules(), $rules);
    }
}
