<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $table = 'article';

    protected $dates = ['published_at'];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'author',
        'tags',
        'is_show',
        'is_approved',
        'article_category_id'
    ];

    public function article_category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id')->withTrashed();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
