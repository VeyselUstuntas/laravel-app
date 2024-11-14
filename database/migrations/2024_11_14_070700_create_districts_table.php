<?php

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
        Schema::create('districts', function (Blueprint $table) {
            $table->increments("id"); 
            $table->unsignedInteger("city_id");
            $table->foreign("city_id")
                ->references("id")
                ->on("cities")
                ->onDelete("cascade");
            $table->string("name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('districts', function (Blueprint $table) {
            Schema::dropIfExists('districts');
            Schema::dropIfExists('cities');
        });
    }
};
