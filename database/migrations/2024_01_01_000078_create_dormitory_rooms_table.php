<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dormitory_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dormitory_id')->nullable()->index();
            $table->unsignedBigInteger('room_type_id')->nullable()->index();
            $table->string('name')->nullable();
            $table->integer('no_of_beds')->nullable();
            $table->decimal('cost_per_bed', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dormitory_rooms');
    }
};
