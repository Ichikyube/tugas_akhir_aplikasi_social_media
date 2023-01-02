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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->unsignedBigInteger('creatorId');
            $table->unsignedBigInteger('serialId');
            $table->string('title');
            $table->string('slug');
            $table->text('caption');
            $table->unsignedBigInteger('media_filesId');
            $table->unsignedBigInteger('commentId');
            $table->dateTime('createdate');
            $table->dateTime('publishdate')->nullable();
            $table->dateTime('lastReaded')->nullable();
            $table->unsignedBigInteger('likesId');
            $table->integer('tagsId');
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
