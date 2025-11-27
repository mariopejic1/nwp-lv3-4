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
        Schema::table('project_user', function (Blueprint $table) {
            $table->text('obavljeni_poslovi')->nullable();
        });
    }

    public function down()
    {
        Schema::table('project_user', function (Blueprint $table) {
            $table->dropColumn('obavljeni_poslovi');
        });
    }

};
