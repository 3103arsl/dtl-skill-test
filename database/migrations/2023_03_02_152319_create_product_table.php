<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('creator_id')->unsigned()->nullable();
            $table->bigInteger('updator_id')->unsigned()->nullable();
            $table->string('name', 255)->nullable();
            $table->decimal('price',10, 2)->default(0)->nullable();
            $table->integer('type')->default(1)->nullable()->comment('1=Product, 2=Service');
            $table->tinyInteger('status')->default(1)->nullable()->comment('0 Inactive, 1 Active');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updator_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
