<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;
    use \App\Models\Concerns\Translatable;

    protected $fillable = [
        'name',
        'name_sw',
        'title',
        'title_sw',
        'designation',
        'designation_sw',
        'bio',
        'bio_sw',
        'photo',
        'category',
        'email',
        'phone',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('display_order');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getCategoryLabelAttribute()
    {
        return match($this->category) {
            'tribunal_member' => 'Tribunal Member',
            'management' => 'Management',
            'secretariat' => 'Secretariat',
            default => 'Staff',
        };
    }
}
