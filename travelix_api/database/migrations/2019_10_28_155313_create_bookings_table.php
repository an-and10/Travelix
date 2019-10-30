<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->integer('amount_paid');
            $table->integer('amount_balance');
            $table->boolean('picked_facility');
            $table->string('address');
            $table->integer('adult');
            $table->integer('children');
            $table->integer('package_id');
            $table->string('status')->default('Active');
            $table->string('email');
            $table->string('contact');
            $table->string('package_name');

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
        Schema::dropIfExists('bookings');
    }
}
