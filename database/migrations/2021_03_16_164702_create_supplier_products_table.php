<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supply_id');//suppliers foreign Id
            $table->foreignId('product_id');//products foreign Id
            $table->timestamps();
            $table->softDeletes();

            //foreign keys
            $table->foreign('supply_id')->references('id')->on('suppliers')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_products', function (Blueprint $table) {
            $table->dropForeign('supply_id');
            $table->dropForeign('product_id');
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('supplier_products');
    }
}
