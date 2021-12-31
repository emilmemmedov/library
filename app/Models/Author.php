<?php

namespace App\Models;

use App\Scopes\UserTypeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Author extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = ['password'];

    protected $table = 'users';

    const type = User::AUTHOR_TYPE;

    protected static function boot()
    {
        static::addGlobalScope(new UserTypeScope(self::type));
        parent::boot();
    }
}
