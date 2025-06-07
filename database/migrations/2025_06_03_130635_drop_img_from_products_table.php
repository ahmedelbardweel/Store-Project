<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // نحذف العمود img نهائيًا (أيّ بياناته ستُفقد)
            $table->dropColumn('img');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // لإرجاع الوراء: نعيد إنشاء العمود img كـ string غير قابل للقيم الفارغة
            $table->string('img');
        });
    }
};
