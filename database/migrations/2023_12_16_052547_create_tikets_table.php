<?php

use App\Models\Flight;
use App\Models\Seat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate()->nullable();
            $table->string('birth_certificate_num')->nullable();
            $table->date('birthday');
            $table->foreignIdFor(Seat::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Flight::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('price');
            $table->string('fio')->nullable();
            $table->string('fio_buy')->nullable();
            $table->string('passport_seria_number')->unique()->nullable();
            $table->string('status')->default('бронь');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tikets');
    }
};
