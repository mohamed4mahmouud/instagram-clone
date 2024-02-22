<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=[
        'body'
    ];

    public function user(){
        $this->belongsTo(User::class);
    }
    public function post(){
        $this->belongsTo(Post::class);
    }
}
