<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProfileTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('profile', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['user_id']);

            // Change the user_id column to be the primary key
            $table->primary('user_id');

            // Add a new foreign key constraint
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('profile', function (Blueprint $table) {
            // Drop the primary key constraint
            $table->dropPrimary(['user_id']);

            // Drop the foreign key constraint
            $table->dropForeign(['user_id']);

            // Add back the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}