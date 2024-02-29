<?php
namespace App\Models;
use App\Models\Like;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'fullName',
        'email',
        'password',
        'userName',
        'gender',
        'phone',
        'email',
        'email_verified_at',
        'phone',
        'verification_token',
        'reset_password_token',
        'followers_count',
        'following_count',
        'facebook_id'

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
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function savedposts(){
        return $this->hasMany(SavedPost::class);
    }
}
