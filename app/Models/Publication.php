<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'file_path',
        'file_size',
        'file_type',
        'category',
        'cover_image',
        'year',
        'is_published',
        'download_count',
        'created_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'download_count' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($pub) {
            if (empty($pub->slug)) {
                $pub->slug = Str::slug($pub->title);
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
            'acts_and_rules' => 'Acts and Rules',
            'strategic_plan' => 'Strategic Plan',
            'client_service_charter' => 'Client Service Charter',
            'annual_report' => 'Annual Report',
            default => 'Publication',
        };
    }
}
