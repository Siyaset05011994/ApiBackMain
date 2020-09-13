<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistic_facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('lat', 9, 6);
            $table->float('lng', 9, 6);
            $table->jsonb('parameters')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->timestamps();

            $table->foreign('type_id')
                ->references('id')
                ->on('logistic_facility_types')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logistic_facilities');
    }
}
