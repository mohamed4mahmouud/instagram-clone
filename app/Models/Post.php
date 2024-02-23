<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'images',
        'caption',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function tags(){
        return $this -> hasMany(Tag::class);
    }
}
