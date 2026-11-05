<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $photos = [
            'Tenda Semi Dekorasi Plafon VIP' => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=1200&q=85',
            'Flooring Kayu & Karpet Buana' => 'https://images.unsplash.com/photo-1519710164239-da123dc03ef4?auto=format&fit=crop&w=1200&q=85',
            'AC Standing 5 PK & Misty Fan' => 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=1200&q=85',
            'Sound System 5.000 Watt' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=1200&q=85',
            'Sound System Konser 10.000 Watt' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=1200&q=85',
            'Digital Audio Mixer 32 Channel' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1200&q=85',
            'Smoke Machine & Dry Ice Low Fog' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1200&q=85',
            'Kursi Futura + Cover Ketat & Pita' => 'https://images.unsplash.com/photo-1503602642458-232111445657?auto=format&fit=crop&w=1200&q=85',
            'Kursi Tiffany Putih & Gold VIP' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?auto=format&fit=crop&w=1200&q=85',
            'Meja IBM Seminar 45x180 + Skirting' => 'https://images.unsplash.com/photo-1517502884422-41eaead166d4?auto=format&fit=crop&w=1200&q=85',
            'Smart TV 55-65 Inch + Standing Bracket' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?auto=format&fit=crop&w=1200&q=85',
            'Genset Silent 10 kVA' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=1200&q=85',
            'Genset Silent 40 kVA Heavy Duty' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1200&q=85',
            'Kabel Distribusi & Box Panel Listrik' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=1200&q=85',
            'Podium Pidato Akrilik Transparan VIP' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=1200&q=85',
            'Mojo Barrier Barricade Panggung' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=1200&q=85',
        ];

        foreach ($photos as $name => $photo) {
            DB::table('rental_items')->where('name', $name)->update([
                'photo' => $photo,
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        // Seeder remains source of truth for catalog images after rollback.
    }
};
