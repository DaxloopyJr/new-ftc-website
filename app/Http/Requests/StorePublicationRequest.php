<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isEditor();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:publications,slug',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'category' => 'required|in:acts_and_rules,strategic_plan,client_service_charter,annual_report',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'year' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'is_published' => 'boolean',
        ];
    }
}
