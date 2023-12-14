<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlphaNews extends Model
{
    use HasFactory;
    protected $table = 'alphanews';
    protected $fillable = [
        'title',
        'description',
        'author',
        'url',
        'urlToImage',
        'publishedAt',
        'content',
        'source_name',
    ];
}
