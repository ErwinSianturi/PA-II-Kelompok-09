<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengalamanKerjaTable extends Migration
{
    public function up()
    {
        Schema::create('pengalaman_kerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to 'profils' table
            $table->string('position', 100);
            $table->string('company_name', 100);
            $table->string('country', 100);
            $table->string('city', 100);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(0);
            $table->string('job_function', 100);
            $table->string('industry', 100);
            $table->string('job_level', 100);
            $table->string('job_type', 100);
            $table->text('description')->nullable();
            $table->timestamps();

            // Foreign key constraint linking user_id to 'profils' table
            $table->foreign('user_id')->references('id')->on('profils')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengalaman_kerja');
    }
}
