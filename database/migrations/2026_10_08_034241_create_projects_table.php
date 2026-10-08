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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Tên dự án
            $table->string('title');

            // Mô tả dự án
            $table->text('description')->nullable();

            // Đường dẫn hình ảnh
            $table->string('image')->nullable();

            // Công nghệ sử dụng
            $table->string('technologies')->nullable();

            // Link GitHub
            $table->string('github_url')->nullable();

            // Link demo
            $table->string('demo_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};