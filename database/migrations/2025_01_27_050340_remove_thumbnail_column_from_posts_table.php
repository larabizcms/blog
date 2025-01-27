<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use LarabizCMS\Modules\Blog\Models\PostTranslation;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $posts = DB::table('post_translations')->whereNotNull('thumbnail')->get();
        $models = PostTranslation::whereIn('id', $posts->pluck('id'))
            ->get()
            ->keyBy('id');

        foreach ($posts as $post) {
            $model = $models[$post->id];
            $model->attachMedia($post->thumbnail, 'thumbnail');
        }

        Schema::table('post_translations', function (Blueprint $table) {
            $table->dropForeign(['thumbnail']);
            $table->dropColumn(['thumbnail']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('post_translations', function (Blueprint $table) {
            $table->string('thumbnail')->nullable();
        });
    }
};
