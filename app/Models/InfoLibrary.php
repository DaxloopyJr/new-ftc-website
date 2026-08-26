<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InfoLibrary extends Model
{
    use HasFactory;

    protected $table = 'info_library';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'file_path',
        'file_size',
        'file_type',
        'category',
        'case_number',
        'parties',
        'decision_date',
        'is_published',
        'download_count',
        'created_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'decision_date' => 'date',
        'download_count' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->title);
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getCategoryLabelAttribute()
    {
        return match($this->category) {
            'case_digest' => 'Case Digest',
            'decided_cases' => 'Decided Cases',
            'registered_cases' => 'Registered Cases',
            'cause_list' => 'Cause List',
            'brochure' => 'Brochures',
            default => 'Document',
        };
    }
}
