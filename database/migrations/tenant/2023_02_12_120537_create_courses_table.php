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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('original_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('icon');
            $table->string('image')->nullable();
            $table->longtext('description');
            $table->time('estimated_time');
            $table->boolean('required_passing_modules');
            $table->integer('passing_score');
            $table->string('status')->nullable();
            $table->timestamp('cloned_at')->nullable();
            $table->string('tenant_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('courses');
    }
};
