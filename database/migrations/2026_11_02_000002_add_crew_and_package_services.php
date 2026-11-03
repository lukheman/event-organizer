<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('services')->updateOrInsert(
            ['slug' => 'sewa-crew'],
            [
                'category' => 'sewa-crew',
                'name' => 'Sewa Crew',
                'description' => 'Crew profesional untuk membantu operasional, registrasi, usher, teknis, dan koordinasi acara.',
                'features' => json_encode(['Crew berpengalaman', 'Briefing dan koordinasi', 'Dukungan selama acara']),
                'sort_order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );

        DB::table('services')->updateOrInsert(
            ['slug' => 'paket-event'],
            [
                'category' => 'paket',
                'name' => 'Paket Event',
                'description' => 'Paket event praktis yang menggabungkan kebutuhan konsep, crew, produksi, dan perlengkapan sesuai skala acara.',
                'features' => json_encode(['Pilihan paket fleksibel', 'Koordinasi satu pintu', 'Penyesuaian sesuai anggaran']),
                'sort_order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }

    public function down(): void
    {
        DB::table('services')->whereIn('slug', ['sewa-crew', 'paket-event'])->delete();
    }
};
