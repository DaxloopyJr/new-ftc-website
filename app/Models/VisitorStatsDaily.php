<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorStatsDaily extends Model
{
    use HasFactory;

    protected $table = 'visitor_stats_daily';

    protected $fillable = [
        'date',
        'total_visits',
        'unique_visitors',
        'page_views',
    ];

    protected $casts = [
        'date' => 'date',
        'total_visits' => 'integer',
        'unique_visitors' => 'integer',
        'page_views' => 'integer',
    ];
}
