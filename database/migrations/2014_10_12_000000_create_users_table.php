<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('national_code')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('slug')->unique()->nullable();
            $table->text('profile_photo_path')->nullable()->comment('avatar');
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('activation')->default(0);
            $table->timestamp('activation_at')->nullable();
            $table->tinyInteger('user_type')->default(0)->comment('0 => user, 1 => admin');
            $table->tinyInteger('status')->default(0);
            $table->foreignId('current_team_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
