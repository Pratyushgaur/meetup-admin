<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->string('post_title',255);
            $table->integer('price')->nullable();
            $table->enum('post_type',["0","1"])->comment('0 for exlusive and 1 for prime');
            $table->integer('plan_id')->nullable()->comment('if post type 1 then plan id exist');
            $table->enum("file_type",["image","video"]);
            $table->string('main_file')->comment('main file path will be store here and only file name will store');
            $table->string('more_files')->nullable()->comment('Other multiple file will store here with in json');
            $table->string('video_thumbnail')->nullable()->comment('video thumbnail img if post type video');
            $table->integer("like_count")->default(0);
            $table->decimal("total_earn")->default(0);
            $table->integer("total_unlock")->default(0);
            //$table->integer("total_view")->default(0);
            $table->tinyInteger("status")->default(0)->comment('0 = active | 1 = inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
