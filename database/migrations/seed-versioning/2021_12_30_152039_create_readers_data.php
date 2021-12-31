<?php

use App\Models\Reader;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateReadersData extends Migration
{
    private $readers = [
        [
            'id' => 6,
            'name' => 'Jorg',
            'email' => 'jorg2@gmail.com',
            'password' => '$2y$10$MZ.dJ5HBw4QVq4mAMmCLR.iyzorY.zbtC0m/.rZ7FLJhmc7EpFPqW', //lib123
            'type' => User::READER_TYPE
        ],
        [
            'id' => 7,
            'name' => 'Melisa',
            'email' => 'jony2@gmail.com',
            'password' => '$2y$10$wtQzP19vttM/P7jd22wF5ulw9iJMEGjPptpwwILBCLOYVE9JUnXeC', //lib321
            'type' => User::READER_TYPE
        ],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->readers as $reader) {
            Reader::updateOrCreate(
                ['id' => $reader['id']],
                $reader
            );
        }
    }
}
