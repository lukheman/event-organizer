<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Platform media sosial tambahan beserta ikon Font Awesome.
     *
     * @var array<int, array{platform: string, url: string, icon: string, sort_order: int}>
     */
    private array $links = [
        ['platform' => 'Instagram', 'url' => 'https://instagram.com', 'icon' => 'fa-brands fa-instagram', 'sort_order' => 1],
        ['platform' => 'Facebook', 'url' => 'https://facebook.com', 'icon' => 'fa-brands fa-facebook-f', 'sort_order' => 2],
        ['platform' => 'TikTok', 'url' => 'https://tiktok.com', 'icon' => 'fa-brands fa-tiktok', 'sort_order' => 3],
        ['platform' => 'YouTube', 'url' => 'https://youtube.com', 'icon' => 'fa-brands fa-youtube', 'sort_order' => 4],
        ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com', 'icon' => 'fa-brands fa-linkedin-in', 'sort_order' => 5],
    ];

    public function up(): void
    {
        foreach ($this->links as $link) {
            $exists = DB::table('social_links')->where('platform', $link['platform'])->exists();

            if ($exists) {
                continue;
            }

            DB::table('social_links')->insert([
                ...$link,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('social_links')
            ->whereIn('platform', ['Facebook', 'TikTok', 'YouTube', 'LinkedIn'])
            ->delete();
    }
};
