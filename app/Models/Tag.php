<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Tag extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $dates = ['deleted_at'];
    protected $fillable = ['name'];

    public function subscribes()
    {
        return $this->morphMany('App\Models\Subscribe', 'subscribable');
    }
    public function icon()
    {
        $image = ($this->getMedia('tag-preview')->first()) ? $this->getMedia('tag-preview')->first()->getUrl() : asset('images/user-not-found.png');
        return $image;
    }
    public function articles()
    {
        return $this->hasMany('App\Models\Article', 'tag');
    }
}
