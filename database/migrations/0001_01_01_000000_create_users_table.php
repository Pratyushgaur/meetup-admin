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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("username")->nullable();
            $table->string('mobile')->unique();
            $table->string('country_code');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('gender',["male","female"]);
            $table->enum('role',["1","2"])->comment("1=influencer 2=user");
            $table->tinyInteger('status')->default(0)->comment('0 = Active | 1 = Inactive');
            $table->integer('commission')->default(0);
            $table->decimal('balance',16,2)->default(0);
            $table->string('reff_code')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('service_label_name')->nullable()->comment('name of service will show in profle section');
            $table->string('plan_label_name')->nullable()->comment('name of service will show in profle section');
            $table->string('avtar')->nullable();
            $table->string('cover')->nullable();
            $table->text('bio')->nullable();
            $table->string('app_theme_color')->nullable();
            $table->text('instagram_url')->nullable();
            $table->text('snapchat_url')->nullable();
            $table->text('twitter_url')->nullable();
            $table->text('youtube_url')->nullable();
            $table->text('facebook_url')->nullable();
            $table->text('linkedin_url')->nullable();
            //$table->foreign('category_id')->references('id')->on('categories');


            

            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
