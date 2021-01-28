<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Subscribe extends Model
{
    use HasFactory;

    protected $table = 'subscribable';
    protected $fillable = ['user_id', 'subscribable_id', 'subscribable_type'];

    public function subscribable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'user_id');
    }
    public function tag()
    {
        return $this->belongsTo('App\Models\Tags', 'user_id');
    }
}
