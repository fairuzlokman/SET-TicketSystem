<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
            'category_id' => 'exists:categories,id',
            'priority_id' => 'exists:priorities,id',
            'status_id' => 'exists:statuses,id',
            'title' => 'string',
            'description' => 'string',
            'assign_user_id' => 'exists:users,id'
        ];
    }
}
