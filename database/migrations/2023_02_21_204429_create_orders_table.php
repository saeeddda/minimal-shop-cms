<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('address_object')->nullable();
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('payment_object')->nullable();
            $table->tinyInteger('payment_type')->default(0);
            $table->tinyInteger('payment_status')->default(0);
            $table->foreignId('delivery_id')->nullable()->constrained('delivery')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('delivery_object')->nullable();
            $table->decimal('delivery_amount',20,3)->nullable();
            $table->tinyInteger('delivery_status')->default(0);
            $table->timestamp('delivery_date')->nullable();
            $table->decimal('order_final_amount',20,3)->nullable();
            $table->decimal('order_discount_amount',20,3)->nullable();
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('coupon_object')->nullable();
            $table->decimal('order_coupon_discount_amount',20,3)->nullable();
            $table->foreignId('general_coupon_id')->nullable()->constrained('general_coupons')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('general_coupon_object')->nullable();
            $table->decimal('order_general_coupon_discount_amount',20,3)->nullable();
            $table->decimal('order_total_products_discount_amount',20,3)->nullable();
            $table->tinyInteger('order_status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
