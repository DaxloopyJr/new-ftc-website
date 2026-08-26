<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateAdvertisementRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check() && auth()->user()->isEditor(); }
    public function rules(): array {
        return [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_url' => 'nullable|string|max:500',
            'position' => 'required|in:home_top,home_middle,home_bottom,sidebar',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ];
    }
}
