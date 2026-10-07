<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsEvent extends Model
{
    use HasFactory;
    use \App\Models\Concerns\Translatable;

    protected $table = 'news_events';

    protected $fillable = [
        'title',
        'title_sw',
        'slug',
        'excerpt',
        'excerpt_sw',
        'content',
        'content_sw',
        'featured_image',
        'event_date',
        'location',
        'location_sw',
        'is_announcement',
        'is_published',
        'view_count',
        'published_at',
        'created_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_announcement' => 'boolean',
        'event_date' => 'date',
        'published_at' => 'datetime',
        'view_count' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->whereNotNull('published_at');
    }
}
