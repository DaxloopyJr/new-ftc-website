<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isEditor();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'content' => 'nullable|string',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'parent_id' => 'nullable|exists:pages,id',
            'sort_order' => 'nullable|integer',
            'is_published' => 'boolean',
            'title_sw' => 'nullable|string|max:255',
            'content_sw' => 'nullable|string',
            'org_chart_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:4096',
        ];
    }
}
