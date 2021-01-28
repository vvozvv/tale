<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use HasFactory;
//    protected $dates = ['deleted_at'];

    protected $table = 'favorite';
    protected $fillable = ['user_id', 'article_id'];
}
