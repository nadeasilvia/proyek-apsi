<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('counseling_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->cascadeOnDelete();
            $table->foreignId('psychologist_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('scheduled_at');
            $table->string('session_type', 60);
            $table->string('status', 30)->default('dijadwalkan');
            $table->longText('private_note')->nullable();
            $table->longText('follow_up')->nullable();
            $table->timestamps();
            $table->index(['psychologist_id', 'scheduled_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('counseling_sessions');
    }
};
