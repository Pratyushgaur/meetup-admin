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
        Schema::create('business_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email',50)->nullable();
            $table->string('mobile_no',20)->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('fevicon')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('X_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->longtext('term_condition')->nullable();
            $table->longtext('privacy_policy')->nullable();
            $table->integer('Influancer_default_commission')->default(0);
            $table->decimal('total_income', 20,2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_settings');
    }
};
