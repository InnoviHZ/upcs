<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClearanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearance', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('phone',20);
            $table->string('registration_number',25);
            $table->string('teller_number',15);
            $table->string('serial_number',20);
            $table->string('pin_number',20);
            $table->integer('user_id');
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
        Schema::drop('clearance');
    }
}
