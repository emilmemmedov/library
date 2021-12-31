<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateBookData extends Migration
{
    private $books = [
        [
            'id' => 1,
            'author_id' => 1,
            'name' => 'BookName1',
            'description' => 'dedective',
            'price' => 12,
        ],
        [
            'id' => 2,
            'author_id' => 1,
            'name' => 'BookName2',
            'description' => null,
            'price' => 3,
        ],
        [
            'id' => 3,
            'author_id' => 1,
            'name' => 'BookName3',
            'description' => 'fantastic',
            'price' => 4,
        ],
        [
            'id' => 4,
            'author_id' => 2,
            'name' => 'BookName4',
            'description' => 'romantic',
            'price' => 2,
        ],
        [
            'id' => 5,
            'author_id' => 3,
            'name' => 'BookName5',
            'description' => null,
            'price' => 9,
        ],
        [
            'id' => 6,
            'author_id' => 3,
            'name' => 'BookName6',
            'description' => 'fantastic',
            'price' => 7,
        ],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->books as $book) {
            Book::updateOrCreate(
                ['id' => $book['id']],
                $book
            );
        }
    }
}
