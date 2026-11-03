<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const OLD_TAGLINE = 'Sewa perlengkapan event dengan antar, pasang, dan penarikan.';

    private const NEW_TAGLINE = 'Event organizer profesional untuk konsep, produksi, pelaksanaan, dan perlengkapan acara.';

    public function up(): void
    {
        DB::table('site_settings')
            ->where('key', 'footer_tagline')
            ->where('value', self::OLD_TAGLINE)
            ->update(['value' => self::NEW_TAGLINE, 'updated_at' => now()]);
    }

    public function down(): void
    {
        DB::table('site_settings')
            ->where('key', 'footer_tagline')
            ->where('value', self::NEW_TAGLINE)
            ->update(['value' => self::OLD_TAGLINE, 'updated_at' => now()]);
    }
};
