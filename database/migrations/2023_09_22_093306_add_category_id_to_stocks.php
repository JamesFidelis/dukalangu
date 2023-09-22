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

        Schema::table('inventories', function (Blueprint $table) {
            $table->index('barcode');
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('barcode_no');
            $table->foreign('barcode_no')
                ->references('barcode')
                ->on('inventories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('stocks', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropForeign(['barcode_no']);
            $table->dropColumn('barcode_no');
        });

        // Remove the index from the referenced column 'barcode'
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropIndex(['barcode']);
        });
    }
};
