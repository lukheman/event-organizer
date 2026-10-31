<?php

namespace Database\Seeders;

use App\Models\Collaboration;
use App\Models\CollaborationPhoto;
use App\Models\RentalItem;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\Testimonial;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(['email' => 'admin@gmail.com'], [
            'name' => 'Admin',
            'password' => 'password123',
        ]);

        $services = [
            ['category' => 'pelatihan', 'name' => 'Pelatihan', 'slug' => 'pelatihan', 'description' => 'Program pelatihan interaktif untuk meningkatkan kapasitas tim dan organisasi.', 'features' => ['Modul terstruktur', 'Fasilitator berpengalaman', 'Dokumentasi kegiatan'], 'sort_order' => 1],
            ['category' => 'workshop', 'name' => 'Workshop', 'slug' => 'workshop', 'description' => 'Workshop praktis yang dirancang sesuai tujuan dan kebutuhan peserta.', 'features' => ['Konsep custom', 'Aktivitas kolaboratif', 'Evaluasi pasca-acara'], 'sort_order' => 2],
            ['category' => 'seminar', 'name' => 'Seminar', 'slug' => 'seminar', 'description' => 'Seminar profesional dengan alur acara yang terencana dan pengalaman peserta yang nyaman.', 'features' => ['Rundown acara', 'Manajemen pembicara', 'Registrasi peserta'], 'sort_order' => 3],
            ['category' => 'penyewaan', 'name' => 'Penyewaan Alat', 'slug' => 'penyewaan', 'description' => 'Sewa tenda, sound system, lighting, kursi, panggung, dan perlengkapan acara lainnya.', 'features' => ['Tenda & venue', 'Sound & lighting', 'Kursi, meja & panggung'], 'sort_order' => 4],
        ];
        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }

        foreach ([
            'site_name' => 'Nusa Event',
            'footer_tagline' => 'Sewa perlengkapan event dengan antar, pasang, dan penarikan.',
            'hero_eyebrow' => 'Penyewaan alat event',
            'hero_title' => 'Sewa perlengkapan acara, lengkap dan siap pakai.',
            'hero_subtitle' => 'Tenda, sound system, lighting, kursi, panggung, hingga genset. Cek ketersediaan dan pesan langsung via WhatsApp.',
            'hero_note' => 'Antar, pasang, dan penarikan oleh tim kami.',
            'about' => 'Nusa Event menyediakan penyewaan perlengkapan acara untuk instansi, sekolah, perusahaan, dan komunitas. Kami membantu dari pengecekan stok hingga pemasangan di lokasi.',
            'vision' => 'Menjadi partner penyewaan perlengkapan acara yang paling andal.',
            'mission' => 'Menyediakan alat yang terawat, pengiriman tepat waktu, dan pendampingan teknis di lokasi acara.',
            'address' => 'Jl. Merdeka No. 10, Makassar',
            'email' => 'halo@nusaevent.id',
            'whatsapp_number' => '6281234567890',
            'whatsapp_template' => 'Halo, saya ingin menanyakan ketersediaan alat untuk acara saya.',
            'operating_hours' => 'Senin–Sabtu, 08.00–17.00',
        ] as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $rentalService = Service::query()->where('slug', 'penyewaan')->firstOrFail();

        foreach ([
            ['category' => 'tenda', 'availability' => 'available', 'name' => 'Tenda Roder 5x10', 'description' => 'Tenda rangka untuk acara outdoor dengan kapasitas peserta besar.', 'photo' => 'https://images.unsplash.com/photo-1507504031003-b417219a0fde?auto=format&fit=crop&w=900&q=85', 'sort_order' => 1],
            ['category' => 'tenda', 'availability' => 'available', 'name' => 'Tenda Sarnafil', 'description' => 'Tenda praktis untuk acara komunitas, bazar, dan gathering.', 'photo' => 'https://images.unsplash.com/photo-1472653431158-6364773b2a56?auto=format&fit=crop&w=900&q=85', 'sort_order' => 2],
            ['category' => 'sound', 'availability' => 'available', 'name' => 'Sound System 5000 Watt', 'description' => 'Paket sound system untuk seminar, konser mini, dan acara sekolah.', 'photo' => 'https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?auto=format&fit=crop&w=900&q=85', 'sort_order' => 3],
            ['category' => 'sound', 'availability' => 'available', 'name' => 'Wireless Microphone', 'description' => 'Mikrofon nirkabel untuk pembicara dan moderator.', 'photo' => 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=900&q=85', 'sort_order' => 4],
            ['category' => 'lighting', 'availability' => 'available', 'name' => 'Lighting Par LED', 'description' => 'Lampu panggung untuk memperkuat suasana acara.', 'photo' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=900&q=85', 'sort_order' => 5],
            ['category' => 'lighting', 'availability' => 'available', 'name' => 'Moving Head', 'description' => 'Lampu bergerak untuk panggung dan pertunjukan.', 'photo' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=900&q=85', 'sort_order' => 6],
            ['category' => 'furniture', 'availability' => 'available', 'name' => 'Kursi Futura', 'description' => 'Kursi lipat untuk peserta seminar dan resepsi.', 'photo' => 'https://images.unsplash.com/photo-1507504031003-b417219a0fde?auto=format&fit=crop&w=900&q=85', 'sort_order' => 7],
            ['category' => 'furniture', 'availability' => 'available', 'name' => 'Meja Bundar', 'description' => 'Meja bundar untuk jamuan, registrasi, dan area peserta.', 'photo' => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=900&q=85', 'sort_order' => 8],
            ['category' => 'multimedia', 'availability' => 'available', 'name' => 'Proyektor & Layar', 'description' => 'Paket proyektor dan layar untuk presentasi acara.', 'photo' => 'https://images.unsplash.com/photo-1492724441997-5dc865305da7?auto=format&fit=crop&w=900&q=85', 'sort_order' => 9],
            ['category' => 'multimedia', 'availability' => 'available', 'name' => 'LED Screen', 'description' => 'Layar LED untuk backdrop dan visual acara.', 'photo' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=900&q=85', 'sort_order' => 10],
            ['category' => 'power', 'availability' => 'available', 'name' => 'Genset 10 kVA', 'description' => 'Sumber daya cadangan untuk acara di lokasi tanpa listrik memadai.', 'photo' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=900&q=85', 'sort_order' => 11],
            ['category' => 'lainnya', 'availability' => 'unavailable', 'name' => 'Panggung Portable', 'description' => 'Panggung modular untuk talkshow, band, dan upacara.', 'photo' => 'https://images.unsplash.com/photo-1503095396549-807759245b35?auto=format&fit=crop&w=900&q=85', 'sort_order' => 12],
        ] as $item) {
            RentalItem::updateOrCreate(
                ['service_id' => $rentalService->id, 'name' => $item['name']],
                $item + ['is_active' => true],
            );
        }

        SocialLink::updateOrCreate(['platform' => 'Instagram'], ['url' => 'https://instagram.com', 'icon' => 'fa-brands fa-instagram', 'sort_order' => 1]);

        foreach ([
            ['name' => 'Rina Pratama', 'organization' => 'SMK Harapan', 'photo' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=160&q=85', 'comment' => 'Tenda dan sound system datang tepat waktu. Pemasangan rapi dan timnya responsif.', 'rating' => 5],
            ['name' => 'Andi Saputra', 'organization' => 'PT Karya Nusantara', 'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=160&q=85', 'comment' => 'Sewa kursi, meja, dan proyektor untuk acara kantor. Semua sesuai kebutuhan.', 'rating' => 5],
            ['name' => 'Maya Lestari', 'organization' => 'Komunitas Tumbuh', 'photo' => 'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?auto=format&fit=crop&w=160&q=85', 'comment' => 'Koordinasi pengiriman jelas dan alat yang dipakai berfungsi dengan baik.', 'rating' => 5],
        ] as $testimonial) {
            Testimonial::firstOrCreate(['name' => $testimonial['name']], $testimonial);
        }

        foreach ([
            ['partner_name' => 'SMK Harapan', 'event_name' => 'Seminar Kepemimpinan', 'slug' => 'seminar-kepemimpinan-smk-harapan', 'event_date' => now()->subMonths(2), 'service_category' => 'seminar', 'description' => 'Seminar pengembangan kepemimpinan untuk siswa dengan alur acara yang terencana.'],
            ['partner_name' => 'PT Karya Nusantara', 'event_name' => 'Workshop Kolaborasi Tim', 'slug' => 'workshop-kolaborasi-tim', 'event_date' => now()->subMonths(5), 'service_category' => 'workshop', 'description' => 'Workshop peningkatan kolaborasi lintas divisi untuk tim internal.'],
            ['partner_name' => 'Komunitas Tumbuh', 'event_name' => 'Pelatihan Fasilitator Muda', 'slug' => 'pelatihan-fasilitator-muda', 'event_date' => now()->subMonths(9), 'service_category' => 'pelatihan', 'description' => 'Pelatihan fasilitator untuk komunitas dengan modul dan pendampingan.'],
        ] as $collaboration) {
            $record = Collaboration::updateOrCreate(['slug' => $collaboration['slug']], $collaboration);
            CollaborationPhoto::updateOrCreate(
                ['collaboration_id' => $record->id, 'sort_order' => 1],
                ['photo_path' => match ($record->slug) {
                    'seminar-kepemimpinan-smk-harapan' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=85',
                    'workshop-kolaborasi-tim' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=1200&q=85',
                    default => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=1200&q=85',
                }, 'caption' => 'Dokumentasi kegiatan', 'sort_order' => 1],
            );
        }
    }
}
