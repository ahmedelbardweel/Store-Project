<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->after('id')->nullable();
            // إذا بدك تربطه بفورين كي:
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->dropColumn('product_id');
        });
    }

};
