<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = "comments";
    protected $primaryKey = "id";

    protected $fillable = ["article_id", "user_id", "parent_id", "body", "status"];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function author($id)
    {
        return User::find($id);
    }
    public function authors()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
