<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    public function up()
{
    Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('job_posting_id')->constrained('job_postings')->onDelete('cascade');
        $table->string('user_email');
        $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
        $table->text('alasan');
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
