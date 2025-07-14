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
         Schema::create('inbounds', function (Blueprint $table) {
        $table->id();
        $table->date('receive_date');
        $table->string('no_document');
        $table->string('consignee');
        $table->string('material');
        $table->string('material_description');
        $table->integer('inbound_qty');
        $table->string('uom');
        $table->string('plt_id');
        $table->string('location');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inbounds');
    }
};
