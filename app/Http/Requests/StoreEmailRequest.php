<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'affiliate_id' => 'required|integer',
            'envelope' => 'required|string',
            'from' => 'required|string|max:255|email',
            'subject' => 'required|string',
            'dkim' => 'nullable|string|max:255',
            'SPF' => 'nullable|string|max:255',
            'spam_score' => 'nullable|numeric',
            'email' => 'required|string',
            'raw_text' => 'required|string',
            'sender_ip' => 'nullable|string|max:50',
            'to' => 'required|string|email',
            'timestamp' => 'required|integer',
        ];
    }
}
