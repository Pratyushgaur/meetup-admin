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
        Schema::create('user_wallet_trasactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->enum('transction_type',["0","1"])->comment("0= dr and 1=cr");
            $table->string('transction_title',100);
            $table->text('transction_desc')->nullable();
            $table->decimal('amount',16,2)->default(0);
            $table->integer('influencer_id')->nullable()->comment('this column for chat investment user will be spent current date amount ');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wallet_trasactions');
    }
};
