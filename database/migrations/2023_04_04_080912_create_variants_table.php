<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("product_id");
            $table->string("title");
            $table->integer("gram")->nullable();
            $table->string("price")->nullable();
            $table->string("option1");
            $table->string("option2")->nullable();
            $table->string("option3")->nullable();
            $table->timestamps();
            $table->foreign("product_id")->references("id")->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variants');
    }
};
