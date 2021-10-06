<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_entries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('book_id')->nullable();
            $table->string('date',100)->nullable();
            $table->string('return_date',100)->nullable();
            $table->string('time',100)->nullable();

            $table->string('creator',100)->nullable();
            $table->string('slug',100)->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_entries');
    }
}
