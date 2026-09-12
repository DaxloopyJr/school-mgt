<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fees_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fees_group_id')->nullable()->index();
            $table->unsignedBigInteger('fees_type_id')->nullable()->index();
            $table->unsignedBigInteger('class_id')->nullable()->index();
            $table->decimal('amount', 10, 2)->nullable();
            $table->date('due_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fees_masters');
    }
};
