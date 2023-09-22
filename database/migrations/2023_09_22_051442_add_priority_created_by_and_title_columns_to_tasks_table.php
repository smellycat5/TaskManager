<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by');
            $table->string('title');
            $table->string('priority')->default('medium'); // Change the data type to string
            
            // Define foreign key constraint for 'created_by' column if needed
            // $table->foreign('created_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('title');
            $table->dropColumn('priority');
        });
    }
};
