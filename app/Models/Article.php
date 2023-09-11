<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "articles";

    protected $fillable = ['title', 'slug', 'description', 'feature_img', 'summary', 'author', 'publish_date', 'status'];


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($article) {
            $article->slug = Str::slug($article->title);
            $i = 1;
            while (static::where('slug', $article->slug)->exists()) {
                $article->slug = Str::slug($article->title) . '-' . $i++;
            }
        });

        static::updating(function ($article) {
            $article->slug = Str::slug($article->title);
            $i = 1;
            while (static::where('slug', $article->slug)->where('id', '!=', $article->id)->exists()) {
                $article->slug = Str::slug($article->title) . '-' . $i++;
            }
        });
    }


}
