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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->unsignedBigInteger('jobs_id')->nullable();
            $table->foreign('jobs_id')
                ->references('id')
                ->on('jobs')
                ->onDelete('set null');

            $table->unsignedBigInteger('ppp_id')->nullable();
            $table->foreign('ppp_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->unsignedBigInteger('contacts_id')->nullable();
            $table->foreign('contacts_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->date('od');
            $table->date('do');

            $table->boolean('approved')->nullable();
            $table->boolean('closed')->nullable();
            $table->boolean('certificate')->nullable();

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
        Schema::dropIfExists('contracts');
    }
};
