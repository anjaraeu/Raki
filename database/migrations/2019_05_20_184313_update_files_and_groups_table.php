<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFilesAndGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->boolean('encrypted')->default(false);
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->boolean('encrypted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function(Blueprint $table) {
            $table->dropColumn('encrypted');
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('encrypted');
        });
    }
}
