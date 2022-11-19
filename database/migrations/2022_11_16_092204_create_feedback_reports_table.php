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
        Schema::create('feedback_reports', function (Blueprint $table) {
            $table->id();

            $table->string('subject');
            $table->longText('text');

            $table->unsignedBigInteger('contracts_id')->nullable();
            $table->foreign('contracts_id')
                ->references('id')
                ->on('contracts')
                ->onDelete('set null');

            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

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
        Schema::dropIfExists('feedback_reports');
    }
};
