<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dormitory_assigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dormitory_room_id')->nullable()->index();
            $table->unsignedBigInteger('student_id')->nullable()->index();
            $table->date('assigned_date')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dormitory_assigns');
    }
};
