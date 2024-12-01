<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('group_user', function (Blueprint $table) {
            $table->boolean('payment_done')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('group_user', function (Blueprint $table) {
            $table->dropColumn('payment_done');
        });
    }
};
