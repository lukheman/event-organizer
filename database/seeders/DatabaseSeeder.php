<?php

namespace Database\Seeders;

use App\Models\Collaboration;
use App\Models\CollaborationPhoto;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\TeamMember;
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
            ['category' => 'wedding', 'name' => 'Wedding', 'slug' => 'wedding', 'description' => 'Perencanaan dan pelaksanaan wedding yang personal, rapi, dan berkesan.', 'features' => ['Konsep dan rundown acara', 'Koordinasi vendor dan keluarga', 'Pendampingan hari-H'], 'sort_order' => 1],
            ['category' => 'workshop', 'name' => 'Workshop', 'slug' => 'workshop', 'description' => 'Workshop praktis yang dirancang sesuai tujuan dan kebutuhan peserta.', 'features' => ['Konsep custom', 'Aktivitas kolaboratif', 'Evaluasi pasca-acara'], 'sort_order' => 2],
            ['category' => 'seminar', 'name' => 'Seminar', 'slug' => 'seminar', 'description' => 'Seminar profesional dengan alur acara yang terencana dan pengalaman peserta yang nyaman.', 'features' => ['Rundown acara', 'Manajemen pembicara', 'Registrasi peserta'], 'sort_order' => 3],
            ['category' => 'sewa-crew', 'name' => 'Sewa Crew', 'slug' => 'sewa-crew', 'description' => 'Crew profesional untuk membantu operasional, registrasi, usher, teknis, dan koordinasi acara.', 'features' => ['Crew berpengalaman', 'Briefing dan koordinasi', 'Dukungan selama acara'], 'sort_order' => 4],
            ['category' => 'paket', 'name' => 'Paket Event', 'slug' => 'paket-event', 'description' => 'Paket event praktis yang menggabungkan kebutuhan konsep, crew, produksi, dan perlengkapan sesuai skala acara.', 'features' => ['Pilihan paket fleksibel', 'Koordinasi satu pintu', 'Penyesuaian sesuai anggaran'], 'sort_order' => 5],
            ['category' => 'penyewaan', 'name' => 'Penyewaan Alat', 'slug' => 'penyewaan', 'description' => 'Sewa tenda, sound system, lighting, kursi, panggung, dan perlengkapan acara lainnya.', 'features' => ['Tenda & venue', 'Sound & lighting', 'Kursi, meja & panggung'], 'sort_order' => 6],
        ];
        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }

        foreach ([
            'site_name' => 'Lini Jaya Event',
            'footer_tagline' => 'Event organizer profesional untuk konsep, produksi, pelaksanaan, dan perlengkapan acara.',
            'hero_eyebrow' => 'Event organizer profesional',
            'hero_title' => 'Wujudkan acara yang terencana, berkesan, dan berjalan tanpa hambatan.',
            'hero_subtitle' => 'Lini Jaya Event membantu Anda merancang konsep, mengelola produksi, dan menyediakan perlengkapan untuk setiap kebutuhan acara.',
            'hero_note' => 'Dari konsep hingga eksekusi, satu tim untuk acara Anda.',
            'about' => 'Lini Jaya Event adalah partner event organizer untuk instansi, sekolah, perusahaan, dan komunitas. Kami membantu merancang konsep, mengelola produksi, menjalankan operasional, serta menyediakan perlengkapan agar setiap acara terlaksana dengan rapi dan berkesan.',
            'vision' => 'Menjadi partner event organizer dan penyedia perlengkapan acara yang paling andal.',
            'mission' => 'Menghadirkan perencanaan terstruktur, produksi yang presisi, tim yang responsif, dan perlengkapan terawat untuk setiap acara.',
            'address' => 'Jl. Merdeka No. 10, Makassar',
            'email' => 'halo@linijayaevent.id',
            'whatsapp_number' => '6281234567890',
            'whatsapp_template' => 'Halo, saya ingin menanyakan ketersediaan alat untuk acara saya.',
            'operating_hours' => 'Senin–Sabtu, 08.00–17.00',
        ] as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $this->call(RentalCatalogSeeder::class);

        foreach ([
            ['platform' => 'Instagram', 'url' => 'https://instagram.com', 'icon' => 'fa-brands fa-instagram', 'sort_order' => 1],
            ['platform' => 'Facebook', 'url' => 'https://facebook.com', 'icon' => 'fa-brands fa-facebook-f', 'sort_order' => 2],
            ['platform' => 'TikTok', 'url' => 'https://tiktok.com', 'icon' => 'fa-brands fa-tiktok', 'sort_order' => 3],
            ['platform' => 'YouTube', 'url' => 'https://youtube.com', 'icon' => 'fa-brands fa-youtube', 'sort_order' => 4],
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com', 'icon' => 'fa-brands fa-linkedin-in', 'sort_order' => 5],
        ] as $socialLink) {
            SocialLink::updateOrCreate(['platform' => $socialLink['platform']], $socialLink);
        }

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
            ['partner_name' => 'Keluarga Pratama', 'event_name' => 'Wedding Celebration Pratama', 'slug' => 'wedding-celebration-pratama', 'event_date' => now()->subMonths(9), 'service_category' => 'wedding', 'description' => 'Perayaan wedding dengan konsep personal, koordinasi vendor, dan pendampingan hari-H.'],
        ] as $collaboration) {
            $record = Collaboration::updateOrCreate(['slug' => $collaboration['slug']], $collaboration);

            $photos = match ($record->slug) {
                'seminar-kepemimpinan-smk-harapan' => [
                    'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=1200&q=85',
                ],
                'workshop-kolaborasi-tim' => [
                    'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1200&q=85',
                ],
                default => [
                    'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?auto=format&fit=crop&w=1200&q=85',
                ],
            };

            foreach ($photos as $index => $photoPath) {
                CollaborationPhoto::updateOrCreate(
                    ['collaboration_id' => $record->id, 'sort_order' => $index + 1],
                    ['photo_path' => $photoPath, 'caption' => 'Dokumentasi kegiatan '.($index + 1), 'sort_order' => $index + 1],
                );
            }
        }

        foreach ([
            ['name' => 'Faisal Rahman', 'position' => 'Project Director & Founder', 'photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80', 'sort_order' => 1],
            ['name' => 'Dian Kusuma', 'position' => 'Event Operational Lead', 'photo' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80', 'sort_order' => 2],
            ['name' => 'Rizky Pratama', 'position' => 'Technical & Sound Specialist', 'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80', 'sort_order' => 3],
        ] as $member) {
            TeamMember::updateOrCreate(['name' => $member['name']], $member + ['is_active' => true]);
        }
    }
}
