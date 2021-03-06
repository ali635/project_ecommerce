<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('photo')->nullable();
            $table->longtext('content_ar')->nullable();
            $table->longtext('content_en')->nullable();
            $table->string('code')->nullable();
            
            $table->unsignedBigInteger('department_id')->nullable();
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            
            $table->unsignedBigInteger('trade_id')->nullable();
			$table->foreign('trade_id')->references('id')->on('trade_marks')->onDelete('cascade');
         
            $table->unsignedBigInteger('manu_id')->nullable();
            $table->foreign('manu_id')->references('id')->on('manufacturers')->onDelete('cascade');
            
/*            $table->bigInteger('mall_id')->unsignedBigInteger()->nullable();
            $table->foreign('mall_id')->references('id')->on('malls')->onDelete('cascade');
  */          
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            
            $table->string('size')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');

            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('countries');

            $table->decimal('price', 5, 2)->default(0);

            $table->bigInteger('stock')->default(0);
            
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
            
            $table->date('start_offer_at')->nullable();
            $table->date('end_offer_at')->nullable();
            $table->decimal('price_offer', 5, 2)->default(0);

            $table->longtext('other_date')->nullable();


            
            $table->string('weight')->nullable();
            $table->unsignedBigInteger('weight_id')->nullable();
            $table->foreign('weight_id')->references('id')->on('weights')->onDelete('cascade');

            $table->enum('status', ['pending','refused','active'])->default('pending');
            $table->longtext('reason')->nullable();

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
        Schema::dropIfExists('products');
    }
}
