<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_type');

            $table->unsignedBigInteger('companies_id')->nullable();
            $table->foreign('companies_id')
                ->references('id')
                ->on('companies')
                ->onDelete('set null');

            $table->unsignedBigInteger('study_programs_id')->nullable();
            $table->foreign('study_programs_id')
                ->references('id')
                ->on('study_programs')
                ->onDelete('set null');

            $table->boolean('approved')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
