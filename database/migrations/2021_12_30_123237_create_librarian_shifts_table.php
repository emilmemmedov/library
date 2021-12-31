<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrarianShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('librarian_shifts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('librarian_id');
            $table->integer('day');
            $table->timestamps();
        });
    }
}
