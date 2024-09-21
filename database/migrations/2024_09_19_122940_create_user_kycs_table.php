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
        Schema::create('user_kycs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('pan_card');  
            $table->string('gst_no')->nullable();  
            $table->string('aadhar_no');  
            $table->string('billing_name');  
            $table->text('address');  
            $table->string('city');
            $table->string('pincode',30);  
            $table->string('upi_id')->nullable();  
            $table->string('bank_name')->nullable();  
            $table->string('account_no')->nullable();  
            $table->string('account_holder')->nullable();  
            $table->string('account_ifsc')->nullable();
            $table->text('docs')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 = NotSubmitted | 1= pending | 2 = approve | 3 = Rejected');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_kycs');
    }
};
