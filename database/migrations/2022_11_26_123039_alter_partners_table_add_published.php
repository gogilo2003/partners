<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPartnersTableAddPublished extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'partners',
            function (Blueprint $table) {
                $table->boolean('published')->default(false)->after('socialmedia');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'partners',
            function (Blueprint $table) {
                $table->dropColumn('published');
            }
        );
    }
};
