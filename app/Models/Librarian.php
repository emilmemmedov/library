<?php

namespace App\Models;

use App\Scopes\UserTypeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;

class Librarian extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $guarded = ['id'];

    protected $hidden = ['password'];

    const type = User::LIBRARIAN_TYPE;

    protected static function boot()
    {
        static::addGlobalScope(new UserTypeScope(self::type));
        parent::boot();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class,'librarian_id', 'id');
    }
}
