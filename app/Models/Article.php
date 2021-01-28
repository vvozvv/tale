<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'slug', 'article_text', 'user_id', 'view_count', 'status', 'tag'];

    public function tagKey()
    {
        return $this->belongsTo(Tag::class, 'tag');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')   ;
    }
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->where('parent_id', null)->published();
    }
    public function getAuthor($id)
    {
        return User::where('id', $id)->first();
    }
    public function getTag()
    {
        return $this->tag()->first()->name;
    }
    public function getImage() {
        return (!is_null($this->getMedia('articles')->first())) ? $this->getMedia('articles')->first()->getUrl() : '';
    }
    public function image() {
        return (!is_null($this->getMedia('articles')->first())) ? $this->getMedia('articles')->first() : '';
    }
}
