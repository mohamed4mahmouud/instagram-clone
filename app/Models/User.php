<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'username',
        'gender',
        'phone',
        'followers_count',
        'following_count',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followee_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'followee_id', 'follower_id');
    }

    public function follow(User $userToFollow)
    {
        if (!$this->isFollowing($userToFollow)) {
            $this->following()->attach($userToFollow->id);
            $userToFollow->increment('followers_count');
            $this->increment('following_count');
        }
    }

    public function unfollow(User $userToUnfollow)
    {
        if ($this->isFollowing($userToUnfollow)) {
            $this->following()->detach($userToUnfollow->id);
            $userToUnfollow->decrement('followers_count');
            $this->decrement('following_count');
        }
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('followee_id', $user->id)->exists();
    }

    public function isFollowed()
    {
        $authenticatedUser = User::find(6);
        
        if ($authenticatedUser) {
            return $authenticatedUser->isFollowing($this);
        }
        
        return false;
    }
}
