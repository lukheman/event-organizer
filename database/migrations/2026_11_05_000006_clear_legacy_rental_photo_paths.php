<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $fallbacks = [
            'tenda' => 'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1200&q=85',
            'sound' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=1200&q=85',
            'lighting' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=1200&q=85',
            'furniture' => 'https://images.unsplash.com/photo-1503602642458-232111445657?auto=format&fit=crop&w=1200&q=85',
            'multimedia' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=85',
            'power' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=1200&q=85',
            'lainnya' => 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&w=1200&q=85',
        ];

        DB::table('rental_items')
            ->where('photo', 'like', 'dummy%rental/%')
            ->get(['id', 'category'])
            ->each(function (object $item) use ($fallbacks): void {
                DB::table('rental_items')->where('id', $item->id)->update([
                    'photo' => $fallbacks[$item->category] ?? $fallbacks['lainnya'],
                    'updated_at' => now(),
                ]);
            });
    }

    public function down(): void
    {
        // Legacy dummy files are intentionally not restored.
    }
};
