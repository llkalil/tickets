<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->unique();
            $table->string('disk');
            $table->string('path');
            $table->string('thumb_path')->nullable();
            $table->integer('duration')->nullable();
            $table->string('original_name');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size');

            $table->json('conversions')->nullable();
            $table->string('conversions_disk')->nullable();
            $table->timestamp('converted_at')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
