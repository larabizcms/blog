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
        Schema::create('post_has_taxonomies', function (Blueprint $table) {
            $table->foreignId('post_id')
                ->constrained('posts')
                ->cascadeOnDelete();
            $table->foreignUuid('taxonomy_id')
                ->constrained('taxonomies')
                ->cascadeOnDelete();

            $table->primary(['post_id', 'taxonomy_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_has_taxonomies');
    }
};
