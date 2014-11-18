<?php

use Illuminate\Database\Migrations\Migration;

class SetupUsersTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {

        // Creates the users table
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('remember_token')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
        });

        // Creates password reminders table
        Schema::create('password_reminders', function ($table) {
            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::drop('password_reminders');
        Schema::drop('users');
    }
}
