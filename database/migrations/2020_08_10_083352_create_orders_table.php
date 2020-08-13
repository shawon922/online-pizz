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

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                  ->on('users')->onUpdate('cascade')->onDelete('set null');

            $table->string('billing_name')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_province')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_postalcode')->nullable();
            $table->decimal('subtotal', 10, 3)->default(0);
            $table->decimal('vat', 10, 3)->default(0);
            $table->decimal('shipping_cost', 10, 3)->default(0);
            $table->decimal('total', 10, 3)->default(0);
            $table->boolean('shipped')->default(false);
            $table->string('user_ip', 20)->nullable();
            $table->softDeletes();
            $table->timestamps();
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
