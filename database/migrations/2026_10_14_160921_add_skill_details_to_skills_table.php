<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skills', function (Blueprint $table) {

            // Phân loại kỹ năng
            $table->string('type')
                ->default('programming');

            // Mô tả kỹ năng
            $table->text('description')
                ->nullable();

            // Logo hoặc icon
            $table->string('icon')
                ->nullable();

            // Thứ tự hiển thị
            $table->unsignedInteger('sort_order')
                ->default(0);

            // Kỹ năng cá nhân không cần phần trăm
            $table->unsignedTinyInteger('level')
                ->nullable()
                ->default(null)
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {

            $table->dropColumn([
                'type',
                'description',
                'icon',
                'sort_order',
            ]);

            $table->unsignedTinyInteger('level')
                ->default(50)
                ->change();
        });
    }
};
