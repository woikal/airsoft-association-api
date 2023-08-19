<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('prefix');
            $table->string('postfix');
        });

        Schema::create('club_official', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('role');
            $table->date('start_at');
            $table->date('end_at');
            $table->foreignId('club');
            $table->foreignId('official');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club_official');
        Schema::dropIfExists('officials');
    }
}
