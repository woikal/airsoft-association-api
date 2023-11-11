<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation')->nullable();
            $table->string('club_id')->nullable();
            $table->string('location');
            $table->date('founded_at')->nullable();
            $table->foreignId('province_id')->nullable()->constrained();
            $table->string('logo_filename')->nullable();
            $table->string('website');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('email');
            $table->foreignId('checked_by')->nullable()->constrained('users');
            $table->date('checked_at');
            $table->string('slug')->unique();
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
        Schema::dropIfExists('clubs');
    }
};
