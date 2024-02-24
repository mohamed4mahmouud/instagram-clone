<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'avatar',
        'bio', 
        'website'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
