<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('job_title_en')->nullable();
            $table->string('field_en')->nullable();
            $table->text('short_bio_en')->nullable();
            $table->longText('about_me_en')->nullable();
            $table->longText('career_goal_en')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'job_title_en',
                'field_en',
                'short_bio_en',
                'about_me_en',
                'career_goal_en',
            ]);
        });
    }
};
