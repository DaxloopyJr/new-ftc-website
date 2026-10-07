<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isEditor();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news_events,slug',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'title_sw' => 'nullable|string|max:255',
            'excerpt_sw' => 'nullable|string',
            'content_sw' => 'nullable|string',
            'location_sw' => 'nullable|string|max:255',
            'is_announcement' => 'nullable|boolean',
        ];
    }
}
