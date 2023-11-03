<?php

use App\Enums\GroupType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('abbreviation')->nullable();
            $table->string('zvr');
            $table->enum('type', GroupType::names());
            $table->string('location');
            $table->date('founded_at');
            $table->string('website');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('email');
            $table->foreignId('checked_by')->nullable()->constrained('users');
            $table->date('checked_at');
            $table->string('slug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clubs');
    }
}
