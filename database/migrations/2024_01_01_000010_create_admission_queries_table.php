<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_queries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('class_applied')->nullable();
            $table->string('source')->nullable();
            $table->string('reference')->nullable();
            $table->integer('no_of_child')->nullable();
            $table->date('date')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->string('assigned')->nullable();
            $table->string('status')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_queries');
    }
};
