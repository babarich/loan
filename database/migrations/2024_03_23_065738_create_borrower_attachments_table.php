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
        Schema::create('borrower_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrower_id')->references('id')->on('borrowers')->onDelete('cascade');
            $table->string('filename')->nullable();
            $table->string('attachment_size')->nullable();
            $table->text('attachment')->nullable();
            $table->integer('uploaded_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrower_attachments');
    }
};
