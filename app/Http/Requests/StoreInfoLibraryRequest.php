<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreInfoLibraryRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check() && auth()->user()->isEditor(); }
    public function rules(): array {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:info_library,slug',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'category' => 'required|in:case_digest,decided_cases,registered_cases,cause_list,brochure',
            'case_number' => 'nullable|string|max:100',
            'parties' => 'nullable|string|max:500',
            'decision_date' => 'nullable|date',
            'is_published' => 'boolean',
            'title_sw' => 'nullable|string|max:255',
            'description_sw' => 'nullable|string',
            'registration_date' => 'nullable|date',
            'case_type' => 'nullable|string|max:30|in:appeal,application',
            'status' => 'nullable|string|max:30|in:Hearing,Mention,Judgement',
            'issue' => 'nullable|string|max:255',
        ];
    }
}
