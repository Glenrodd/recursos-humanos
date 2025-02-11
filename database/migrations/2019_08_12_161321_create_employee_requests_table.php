<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees'); //empleado solicitante
            $table->bigInteger('employee_approve_id')->unsigned();
            $table->foreign('employee_approve_id')->references('id')->on('employees'); // persona que tiene la boleta
            $table->bigInteger('request_type_id')->unsigned();
            $table->foreign('request_type_id')->references('id')->on('request_types'); // persona que tiene la boleta
            // $table->enum('type', ['Personal', 'Comisión'])->nullable(); //tipo de solicitud
            $table->date('date');
            $table->time('hour_in');
            $table->time('hour_out');
            $table->string('reason')->nullable();
            $table->string('destiny_place')->nullable();
            $table->string('value1')->nullable();
            $table->string('value2')->nullable();
            $table->string('value3')->nullable();
            $table->string('value4')->nullable();
            $table->string('value5')->nullable();
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
        Schema::dropIfExists('employee_requests');
    }
}
