<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayPowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_powers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->nullable();
            $table->string('company')->nullable();
            $table->string('sensor_number')->nullable();
            $table->string('sensor_id')->nullable();
            $table->string('prefecture')->nullable();
            $table->date('measured_at')->nullable();
            $table->double('used_amount', 10, 4)->nullable()->default(0.0000);
            $table->double('generated_amount', 10, 4)->nullable()->default(0.0000);
            $table->double('purchased_amount', 10, 4)->nullable()->default(0.0000);
            $table->double('solded_amount', 10, 4)->nullable()->default(0.0000);
            $table->double('self_amount', 10, 4)->nullable()->default(0.0000);
            $table->string('purchase_method')->nullable();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->unsignedBigInteger('carport_id')->nullable()->index();
            $table->unsignedBigInteger('file_id')->unsigned()->index();
            $table->text('comment')->nullable();
            $table->timestamps();

            //Relationships
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('carport_id')->references('id')->on('carports')->onDelete('cascade');
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_powers');
    }
}
