<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use InteractsWithMedia, HasFactory, Notifiable, HasRoles, SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'about',
        'instagram',
        'vk',
        'email',
        'password',
        'confirmation_token',
        'email_verified_at'
    ];
//    protected $guarded = ['_token', '_method'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /** Получение все статьи пользователя  */
    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id')->with('comments')->with('likes')->where('status', '=', 2);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    /** Получение все избранное  */
    public function favorites()
    {
        return $this->belongsToMany(Article::class, 'favorite', 'user_id', 'article_id');
    }
    public function getAuthor($id)
    {
        return User::find($id);
    }
    /** Получение лайков пользователя */
    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'user_id');
    }
    /** Получить все подписки пользователя */
    public function subscribes()
    {
//        dd( ($this->morphMany('App\Models\Subscribe', 'user'))->toSql() );
        return $this->morphMany('App\Models\Subscribe', 'subscribable');
    }
    public function subscribe_count()
    {
        return $this->hasMany(Subscribe::class)->whereUserId($this->id)->count();
    }
    /** ??? */
    public function getTotalLikesAttribute()
    {
        return $this->hasMany(Article::class)->whereUserId($this->id)->get();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isSubscribeUser($user_id, $user)
    {
        $record = Subscribe::where('user_id', '=', $user_id)
            ->where('subscribable_id', '=', $user)
            ->where('subscribable_type', '=', 'App\Models\User')
            ->first();
        return $record;
    }
    public function isSubscribeTag($user_id, $tag)
    {
        $record = Subscribe::where('user_id', '=', $user_id)
            ->where('subscribable_id', '=', $tag)
            ->where('subscribable_type', '=', 'App\Models\Tag')
            ->first();
        return $record;
    }
    public function isFavorite()
    {
        return (bool) $this->favorites->first();
    }

    /** Проверка на лайк
     * @param Article $article
     * @return bool
     */
    public function isLike(Article $article)
    {

        return (bool) $article->likes
            ->where('user_id', $this->id)
            ->count();
    }

    /** Получить аватарку юзера */
    public function imageUser()
    {
        $image = ($this->getMedia('avatars')->first()) ? $this->getMedia('avatars')->first()->getUrl() : asset('images/user-not-found.png');
        return $image;
    }


    public function isVerify()
    {
        return is_null($this->email_verified_at);
    }


    public function confirm()
    {
        $this->update(['email_verified_at' => Carbon::now(), 'confirmation_token' => null]);
        return $this;
    }

    public function getEmailConfirmationToken()
    {
        $this->update([
            'confirmation_token' => $token = Str::random(),
        ]);

        return $token;
    }


}
