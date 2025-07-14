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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->date('receive_date');
            $table->string('location');
            $table->string('plt_id');
            $table->string('material');
            $table->string('material_description');
            $table->string('uom');
            $table->integer('unrestricted')->default(0);
            $table->integer('blocked')->default(0);
            $table->text('remarks')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
