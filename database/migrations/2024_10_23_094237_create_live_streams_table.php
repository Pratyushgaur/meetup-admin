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
        Schema::create('live_streams', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->enum('is_scheduled',["0","1"])->default("0");
            $table->datetime('scheduled_time')->nullable();
            $table->decimal('price',16,2)->default(0);
            $table->text('token')->nullable();
            $table->enum('is_end',["0","1"])->default("0");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_streams');
    }
};
