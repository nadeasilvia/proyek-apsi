<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_summons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedTinyInteger('sequence');
            $table->string('target_name');
            $table->string('target_role')->nullable();
            $table->dateTime('scheduled_at');
            $table->string('location');
            $table->string('status')->default('surat_diterbitkan');
            $table->dateTime('delivered_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['report_id', 'sequence']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_summons');
    }
};
