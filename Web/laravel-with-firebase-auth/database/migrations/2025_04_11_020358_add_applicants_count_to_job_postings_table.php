<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->integer('applicants_count')->default(0); // Add applicants_count column
        });
    }

    public function down()
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropColumn('applicants_count'); // Remove the column if rolling back
        });
    }
};
