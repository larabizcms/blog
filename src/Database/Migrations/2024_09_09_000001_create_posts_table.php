<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('type', 50)->index()->default('post');
            $table->string('status', 20)->index()->default('draft');
            $table->timestamps();
        });

        Schema::create('post_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 10);
            $table->string('title');
            $table->string('slug', 190)->index();
            $table->text('content');
            $table->timestamps();

            $table->unique(['post_id', 'locale']);
            $table->foreignId('post_id')
                ->constrained('posts')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_translations');
        Schema::dropIfExists('posts');
    }
};
