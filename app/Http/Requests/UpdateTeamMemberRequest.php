<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateTeamMemberRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check() && auth()->user()->isEditor(); }
    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|in:tribunal_member,management,secretariat',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ];
    }
}
