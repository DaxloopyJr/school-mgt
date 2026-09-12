<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id')->nullable()->index();
            $table->unsignedBigInteger('library_member_id')->nullable()->index();
            $table->date('issue_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('returned_at')->nullable();
            $table->decimal('fine', 10, 2)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_issues');
    }
};
