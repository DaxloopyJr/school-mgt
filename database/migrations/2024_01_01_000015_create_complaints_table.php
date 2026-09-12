<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('complain_by')->nullable();
            $table->string('complaint_type')->nullable();
            $table->string('phone')->nullable();
            $table->date('date')->nullable();
            $table->string('source')->nullable();
            $table->string('assigned')->nullable();
            $table->string('action_taken')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
