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
            $table->timestamps();
    
            $table->string('assetName');
            $table->string('code');
            $table->boolean('hasSerial')->default(false);
            $table->boolean('hasExpiry')->default(false);
            $table->boolean('fixAsset')->default(false);
            $table->boolean('pms')->default(false);
            $table->boolean('calibration')->default(false);
            $table->string('desc');
    
            $table->unsignedBigInteger('uom_id')->nullable(); // Foreign key column
            
            $table->index('uom_id'); // Index to improve foreign key performance
            $table->foreign('uom_id') // Define the foreign key constraint
                  ->references('id')
                  ->on('uoms')
                  ->onDelete('set null'); // Set uom_id to null if the related uoms record is deleted
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
