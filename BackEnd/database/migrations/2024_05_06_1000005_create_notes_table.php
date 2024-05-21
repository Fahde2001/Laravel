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
        Schema::create('notes', function (Blueprint $table) {
            $table->id('idNote');
            $table->integer('note');
            $table->string('mattreName');
            $table->integer('coefficient');
            $table->unsignedBigInteger('supply_chains');
            $table->unsignedBigInteger('student');
            $table->foreign('supply_chains')->references('idSupply')->on('supply_chains');
            $table->foreign('student')->references('idStudent')->on('students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
