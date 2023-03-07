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
        Schema::create('product_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('creator_id')->unsigned()->nullable();
            $table->integer('product_id')->default(1);
            $table->json('old_properties')->nullable();
            $table->json('new_properties')->nullable();
            $table->timestamps();
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_history');
    }
};
