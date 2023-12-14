<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NytimesNews extends Model
{
    use HasFactory;
    
    protected $table = 'nytimes_articles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'abstract',
        'web_url',
        'snippet',
        'lead_paragraph',
        'source',
        'url_imagen',
        'keywords',
        'pub_date',
        'document_type',
        'news_desk',
        'section_name',
        'subsection_name',
        'byline_original',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'pub_date' => 'datetime',
    ];
}

