<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_books', function (Blueprint $table) {
            $table->id();
            $table->string('purpose')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->integer('no_of_persons')->nullable();
            $table->date('date')->nullable();
            $table->string('in_time')->nullable();
            $table->string('out_time')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_books');
    }
};
