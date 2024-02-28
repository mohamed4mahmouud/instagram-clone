<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavedPost extends Model
{
    protected $table = 'users_saved_posts';

    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
