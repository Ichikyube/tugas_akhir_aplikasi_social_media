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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commented_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('parent_id')->unsigned();
            $table->text('body');
            $table->integer('commentable_id')->unsigned();
            $table->string('commentable_type');
            $table->unsignedBigInteger('likeId');
            $table->unsignedBigInteger('replyId');
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
        Schema::dropIfExists('comments');
    }
};
