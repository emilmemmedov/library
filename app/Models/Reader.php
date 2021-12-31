<?php

namespace App\Models;

use App\Scopes\UserTypeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;

class Reader extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $guarded = ['id'];

    protected $hidden = ['password'];

    const type = User::READER_TYPE;

    protected static function boot()
    {
        static::addGlobalScope(new UserTypeScope(self::type));
        parent::boot();
    }

    public function completedOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'reader_id', 'id')->whereNotNull('return_date');
    }

    public function nonCompletedOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'reader_id', 'id')->whereNull('return_date');
    }
}
