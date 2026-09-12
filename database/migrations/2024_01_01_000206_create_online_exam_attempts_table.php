<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_exam_attempts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('online_exam_id')->nullable()->index();
            $table->unsignedBigInteger('student_id')->nullable()->index();
            $table->text('answers')->nullable();
            $table->decimal('score', 10, 2)->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_exam_attempts');
    }
};
