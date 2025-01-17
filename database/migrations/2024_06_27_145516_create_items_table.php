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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('catalog_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->integer('qty');
            $table->string('item');
            $table->integer('amount');
            $table->string('production');
            $table->foreignId('employee_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('vendor_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
