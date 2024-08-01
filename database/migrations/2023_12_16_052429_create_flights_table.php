<?php

use App\Models\Airplane;
use App\Models\Airport;
use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_from_id');
            $table->unsignedBigInteger('city_to_id');
            $table->unsignedBigInteger('airport_from_id');
            $table->unsignedBigInteger('airport_to_id');
            $table->string('number');
            $table->float('price')->default(0);
            $table->float('procent');
            $table->string('status')->default('готов'); //готов, в полете, отменен, прибыл
            $table->foreignIdFor(Airplane::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('city_from_id')->references('id')->on('cities'); //город вылета
            $table->foreign('city_to_id')->references('id')->on('cities'); //город прилета
            $table->foreign('airport_from_id')->references('id')->on('airports'); //аэропорт вылета
            $table->foreign('airport_to_id')->references('id')->on('airports'); //аэропорт прилета
            $table->dateTime('departure_time'); //время вылета
            $table->dateTime('arrival_time'); //время прилета
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
