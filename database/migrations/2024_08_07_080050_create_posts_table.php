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
            $table->bigInteger('user_id');
            $table->string('post_title',255);
            $table->enum('post_type',["Execlusive","Prime"]);
            $table->enum("file_type",["image","video"]);
            $table->integer("like_count")->default(0);
            $table->decimal("total_earn")->default(0);
            $table->integer("total_unlock")->default(0);
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
