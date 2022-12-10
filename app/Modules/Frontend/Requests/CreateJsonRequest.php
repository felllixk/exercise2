<?php

namespace App\Modules\Frontend\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJsonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['string', 'min:5', 'max:10'],
            'surname'   => ['string', 'min:5', 'max:10'],
        ];
    }
}
