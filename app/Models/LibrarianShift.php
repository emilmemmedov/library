<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LibrarianShift extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function librarian(): HasOne
    {
        return $this->hasOne(Librarian::class, 'id', 'librarian_id');
    }
}
