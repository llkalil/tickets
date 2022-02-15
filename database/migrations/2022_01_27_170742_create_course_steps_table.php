<?php

use App\Models\Video;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Course::class);
            $table->string('slug');
            $table->string('title');
            $table->boolean('is_active')->default(true);
            $table->string('type'); // Video - Article - Activity

            $table->foreignIdFor(Video::class)->nullable();

            $table->string("subtitle")->nullable();
            $table->longText('contents')->nullable();

            $table->text('question_title')->nullable();

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
        Schema::dropIfExists('course_steps');
    }
}
