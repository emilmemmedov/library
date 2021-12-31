<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function book(): HasOne
    {
        return $this->hasOne(Book::class,'id', 'book_id');
    }

    public function librarian(): HasOne
    {
        return $this->hasOne(Librarian::class,'id', 'librarian_id');
    }

    public function reader(): HasOne
    {
        return $this->hasOne(Book::class,'id', 'reader_id');
    }

}
