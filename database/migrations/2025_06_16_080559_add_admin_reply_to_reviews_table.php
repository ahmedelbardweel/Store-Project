<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up()
    {
// migration لإضافة user_reply_to_admin
        Schema::table('reviews', function (Blueprint $table) {
            $table->text('admin_reply')->nullable();
            $table->text('user_reply_to_admin')->nullable(); // رد المستخدم على رد الأدمن
        });

    }

    public function down()
    {
// migration لإضافة user_reply_to_admin
        Schema::table('reviews', function (Blueprint $table) {
            $table->text('admin_reply')->nullable();
            $table->text('user_reply_to_admin')->nullable(); // رد المستخدم على رد الأدمن
        });

    }

};
