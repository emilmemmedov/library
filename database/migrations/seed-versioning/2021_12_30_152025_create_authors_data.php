<?php

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsData extends Migration
{
    private $authors = [
        [
            'id' => 1,
            'name' => 'Emil Memmedov',
            'email' => 'emill.memmedovv@gmail.com',
            'password' => '$2y$10$0AlH1RTTaGjUQUVA9XgFgu2UQ0aD1rtFlF9LcwXXmJrTl3P4kqzXS', //pass123
            'type' => User::AUTHOR_TYPE
        ],
        [
            'id' => 2,
            'name' => 'Rehman Esedov',
            'email' => 'rehman@gmail.com',
            'password' => '$2y$10$fH21k1kS.M90Dq/SN1aSje7BLbAYXIDMCqpiEcXv4LFcudBzURgiC', //pass321
            'type' => User::AUTHOR_TYPE
        ],
        [
            'id' => 3,
            'name' => 'Nermin Quliyeva',
            'email' => 'nermin@gmail.com',
            'password' => '$2y$10$diMdMSlfSDXkexvH2vVc5u70aUjdxPPpyFUCshYAU.egu3wsGdwEC', //123pass
            'type' => User::AUTHOR_TYPE
        ],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->authors as $author) {
            Author::updateOrCreate(
                ['id' => $author['id']],
                $author
            );
        }
    }
}
