<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->string('reporter_type');
            $table->longText('reporter_data');
            $table->string('incident_type')->index();
            $table->date('incident_date')->nullable();
            $table->string('incident_time')->nullable();
            $table->text('incident_location')->nullable();
            $table->longText('incident_story');
            $table->text('expectation')->nullable();
            $table->string('status')->default('baru_diterima')->index();
            $table->foreignId('assigned_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('requires_follow_up')->default(false)->index();
            $table->timestamp('referred_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });

        Schema::create('report_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('from_status')->nullable();
            $table->string('to_status');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('evidence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->cascadeOnDelete();
            $table->string('disk')->default('local');
            $table->string('path');
            $table->string('original_name');
            $table->string('mime_type', 120);
            $table->unsignedBigInteger('size');
            $table->timestamps();
        });

        Schema::create('case_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('kind')->default('psikolog');
            $table->timestamps();
            $table->unique(['report_id', 'user_id', 'kind']);
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('report_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action')->index();
            $table->text('reason')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('case_assignments');
        Schema::dropIfExists('evidence');
        Schema::dropIfExists('report_status_histories');
        Schema::dropIfExists('reports');
    }
};
