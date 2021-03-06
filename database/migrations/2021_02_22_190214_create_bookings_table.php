<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('ref');
            $table->string('student_name');
            $table->integer('student_id')->nullable();
            $table->decimal('amount')->nullable();
            $table->integer('room_id');
            $table->integer('occupancy')->default(1);
            $table->string('session');
            $table->string('status')->default('Pending');
            $table->string('actioned_by')->nullable();
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
