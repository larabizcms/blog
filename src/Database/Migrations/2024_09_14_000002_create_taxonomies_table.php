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
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type', 50)->index()->default('post');
            $table->uuid('parent_id')->nullable()->index();
            $table->timestamps();
        });

        Schema::table('taxonomies', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')
                ->on('taxonomies')
                ->onDelete('cascade');
        });

        Schema::create('taxonomy_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 10);
            $table->string('name');
            $table->string('slug', 190)->index();
            $table->string('description', 255)->nullable();
            $table->foreignUuid('taxonomy_id')
                ->constrained('taxonomies')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['taxonomy_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxonomy_translations');
        Schema::dropIfExists('taxonomies');
    }
};
