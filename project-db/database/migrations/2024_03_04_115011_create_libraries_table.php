<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stu_id');
            $table->foreign('stu_id')
                  ->references('id')
                  ->on('students')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');
            $table->string('book');
            $table->date('due_date')->nullable();
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libraries');
    }
};
