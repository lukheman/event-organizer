<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rental_items', function (Blueprint $table) {
            $table->unsignedBigInteger('price_per_day')->nullable()->after('photo');
        });

        foreach ([
            'tenda' => 1500000,
            'sound' => 1000000,
            'lighting' => 750000,
            'furniture' => 250000,
            'multimedia' => 850000,
            'power' => 900000,
            'lainnya' => 500000,
        ] as $category => $price) {
            \DB::table('rental_items')
                ->where('category', $category)
                ->whereNull('price_per_day')
                ->update(['price_per_day' => $price]);
        }
    }

    public function down(): void
    {
        Schema::table('rental_items', function (Blueprint $table) {
            $table->dropColumn('price_per_day');
        });
    }
};
