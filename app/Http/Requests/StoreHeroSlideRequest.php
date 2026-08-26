<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreHeroSlideRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check() && auth()->user()->isEditor(); }
    public function rules(): array {
        return [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ];
    }
}
