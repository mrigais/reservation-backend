<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_setting', function (Blueprint $table) {
            $table->id();
            $table->integer('n');
            $table->enum('d', ['day', 'week', 'month'])->default('day');
            $table->enum('g', ['individual', 'group'])->default('group');
            $table->string('tz');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_setting');
    }
}
