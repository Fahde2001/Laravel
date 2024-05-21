<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('idStudent');
            $table->string('name');
            $table->integer('age');
            $table->string('supplyChainName');
            $table->unsignedBigInteger('supply_chains');
            $table->foreign('supply_chains')->references('idSupply')->on('supply_chains');
            $table->unsignedBigInteger('user_id'); // Changed column name to 'user_id'
            $table->foreign('user_id')->references('id')->on('users'); // Changed foreign key to 'user_id'
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
