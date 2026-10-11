<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            // Thông tin cơ bản
            $table->string('full_name');
            $table->string('job_title')->nullable();
            $table->string('field')->nullable();
            $table->string('location')->nullable();

            // Giới thiệu
            $table->text('short_bio')->nullable();
            $table->longText('about_me')->nullable();
            $table->text('career_goal')->nullable();

            // Ảnh đại diện
            $table->string('avatar')->nullable();

            // Liên hệ và mạng xã hội
            $table->string('contact_email')->nullable();
            $table->string('github_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
