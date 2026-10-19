<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'title_en')) {
                $table->string('title_en')->nullable();
            }

            if (!Schema::hasColumn('projects', 'description_en')) {
                $table->text('description_en')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'title_en')) {
                $table->dropColumn('title_en');
            }

            if (Schema::hasColumn('projects', 'description_en')) {
                $table->dropColumn('description_en');
            }
        });
    }
};
