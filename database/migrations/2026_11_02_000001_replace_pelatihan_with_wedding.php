<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('services')
            ->where('category', 'pelatihan')
            ->update([
                'category' => 'wedding',
                'name' => 'Wedding',
                'slug' => 'wedding',
                'description' => 'Perencanaan dan pelaksanaan wedding yang personal, rapi, dan berkesan.',
                'features' => json_encode(['Konsep dan rundown acara', 'Koordinasi vendor dan keluarga', 'Pendampingan hari-H']),
            ]);

        DB::table('collaborations')
            ->where('service_category', 'pelatihan')
            ->update([
                'partner_name' => 'Keluarga Pratama',
                'event_name' => 'Wedding Celebration Pratama',
                'slug' => 'wedding-celebration-pratama',
                'service_category' => 'wedding',
                'description' => 'Perayaan wedding dengan konsep personal, koordinasi vendor, dan pendampingan hari-H.',
            ]);
    }

    public function down(): void
    {
        DB::table('services')
            ->where('category', 'wedding')
            ->where('slug', 'wedding')
            ->update([
                'category' => 'pelatihan',
                'name' => 'Pelatihan',
                'slug' => 'pelatihan',
                'description' => 'Program pelatihan interaktif untuk meningkatkan kapasitas tim dan organisasi.',
                'features' => json_encode(['Modul terstruktur', 'Fasilitator berpengalaman', 'Dokumentasi kegiatan']),
            ]);

        DB::table('collaborations')
            ->where('service_category', 'wedding')
            ->where('slug', 'wedding-celebration-pratama')
            ->update([
                'partner_name' => 'Komunitas Tumbuh',
                'event_name' => 'Pelatihan Fasilitator Muda',
                'slug' => 'pelatihan-fasilitator-muda',
                'service_category' => 'pelatihan',
                'description' => 'Pelatihan fasilitator untuk komunitas dengan modul dan pendampingan.',
            ]);
    }
};
