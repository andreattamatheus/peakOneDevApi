<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'envelope' => 'sometimes|string',
            'from' => 'sometimes|string|max:255',
            'subject' => 'sometimes|string',
            'dkim' => 'sometimes|string|max:255',
            'SPF' => 'sometimes|string|max:255',
            'spam_score' => 'sometimes|numeric',
            'email' => 'sometimes|string',
            'raw_text' => 'sometimes|string',
            'sender_ip' => 'sometimes|string|max:50',
            'to' => 'sometimes|string',
            'timestamp' => 'sometimes|integer',
        ];
    }
}
