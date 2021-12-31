<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\Librarian;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateLibrarianData extends Migration
{
    private $librarians = [
        [
            'id' => 4,
            'name' => 'Jane Jane',
            'email' => 'jane@gmail.com',
            'password' => '$2y$10$MZ.dJ5HBw4QVq4mAMmCLR.iyzorY.zbtC0m/.rZ7FLJhmc7EpFPqW', //lib123
            'type' => User::LIBRARIAN_TYPE
        ],
        [
            'id' => 5,
            'name' => 'Jony Jony',
            'email' => 'jony@gmail.com',
            'password' => '$2y$10$wtQzP19vttM/P7jd22wF5ulw9iJMEGjPptpwwILBCLOYVE9JUnXeC', //lib321
            'type' => User::LIBRARIAN_TYPE
        ],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->librarians as $librarian) {
            Librarian::updateOrCreate(
                ['id' => $librarian['id']],
                $librarian
            );
        }
    }
}
