<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTvshowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tv_shows', function (Blueprint $table) {
            
            $table->boolean('ended')->default(0);
            $table->string('next_episode_air_date')->nullable()->change();
            $table->integer('next_episode_number')->nullable()->change();
            $table->integer('next_episode_season')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tv_shows', function (Blueprint $table) {
            
            $table->dropColumn('ended');
            $table->string('next_episode_air_date')->nullable(false);
            $table->integer('next_episode_number')->nullable(false);
            $table->integer('next_episode_seasion')->nullable(false);
        });
    }
}
