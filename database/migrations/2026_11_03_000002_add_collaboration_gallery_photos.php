<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Foto dokumentasi tambahan untuk kegiatan contoh yang sudah tersedia.
     *
     * @var array<string, array<int, string>>
     */
    private array $photos = [
        'seminar-kepemimpinan-smk-harapan' => [
            'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=1200&q=85',
            'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=1200&q=85',
        ],
        'workshop-kolaborasi-tim' => [
            'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1200&q=85',
            'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1200&q=85',
        ],
        'wedding-celebration-pratama' => [
            'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1200&q=85',
            'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?auto=format&fit=crop&w=1200&q=85',
        ],
    ];

    public function up(): void
    {
        foreach ($this->photos as $slug => $photos) {
            $collaboration = DB::table('collaborations')->where('slug', $slug)->first();

            if (! $collaboration) {
                continue;
            }

            $sortOrder = (int) DB::table('collaboration_photos')
                ->where('collaboration_id', $collaboration->id)
                ->max('sort_order');

            foreach ($photos as $photoPath) {
                $exists = DB::table('collaboration_photos')
                    ->where('collaboration_id', $collaboration->id)
                    ->where('photo_path', $photoPath)
                    ->exists();

                if ($exists) {
                    continue;
                }

                $sortOrder++;

                DB::table('collaboration_photos')->insert([
                    'collaboration_id' => $collaboration->id,
                    'photo_path' => $photoPath,
                    'caption' => 'Dokumentasi kegiatan '.$sortOrder,
                    'sort_order' => $sortOrder,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        $paths = collect($this->photos)->flatten()->all();

        DB::table('collaboration_photos')->whereIn('photo_path', $paths)->delete();
    }
};
