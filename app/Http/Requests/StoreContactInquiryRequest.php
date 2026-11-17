<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'required_without:whatsapp'],
            'whatsapp' => ['nullable', 'string', 'max:30', 'required_without:email'],
            'event_type' => ['required', 'string', 'max:255'],
            'event_date' => ['nullable', 'date', 'after_or_equal:today'],
            'message' => ['required', 'string', 'max:3000'],
        ];
    }
}
