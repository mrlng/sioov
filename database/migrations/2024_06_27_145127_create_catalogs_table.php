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
        Schema::drop('catalogs');
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('catalog_name');
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('restrict');;
            $table->integer('harga');
            $table->timestamps();
        });
    }
};
