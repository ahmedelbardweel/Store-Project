<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserReplyToAdminToReviewsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('reviews', 'user_reply_to_admin')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->text('user_reply_to_admin')->nullable()->after('admin_reply');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('reviews', 'user_reply_to_admin')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->dropColumn('user_reply_to_admin');
            });
        }
    }

}
