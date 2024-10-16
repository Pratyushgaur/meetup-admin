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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid');
            $table->string('order_id')->unique();
            $table->integer('influencer_id');
            $table->decimal('amount',16,2);

            $table->enum('order_type',['post_unlock','plan_purchase','service_purchase']);
            $table->enum('order_status',['0','1'])->comment('0= pending 1= deliverd 2=reject');
            $table->float('commision')->defalut(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
