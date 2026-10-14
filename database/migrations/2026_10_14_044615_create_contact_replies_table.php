<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_replies', function (Blueprint $table) {
            $table->id();

            // Tin nhắn gốc
            $table->foreignId('contact_id')
                ->constrained('contacts')
                ->cascadeOnDelete();

            // Tài khoản Admin trả lời
            $table->foreignId('admin_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Thông tin email
            $table->string('recipient_email');
            $table->string('subject');
            $table->text('body');

            // Trạng thái gửi
            $table->string('status', 20)->default('pending');

            // Thông báo lỗi nếu gửi thất bại
            $table->text('error_message')->nullable();

            // Thời gian gửi thành công
            $table->timestamp('sent_at')->nullable();

            $table->timestamps();

            $table->index(['contact_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_replies');
    }
};