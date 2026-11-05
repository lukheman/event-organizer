<?php

namespace Database\Seeders;

use App\Models\RentalItem;
use App\Models\Service;
use Illuminate\Database\Seeder;

class RentalCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds for the rental catalog.
     */
    public function run(): void
    {
        $rentalService = Service::query()->where('slug', 'penyewaan')->first()
            ?? Service::create([
                'category' => 'penyewaan',
                'name' => 'Penyewaan Alat',
                'slug' => 'penyewaan',
                'description' => 'Sewa tenda, sound system, lighting, kursi, panggung, dan perlengkapan acara lainnya dengan layanan antar dan pasang.',
                'features' => ['Tenda & venue', 'Sound & lighting', 'Kursi, meja & panggung', 'Genset & multimedia'],
                'sort_order' => 1,
                'is_active' => true,
            ]);

        $items = [
            // 1. Tenda & Venue
            [
                'category' => 'tenda',
                'availability' => 'available',
                'name' => 'Tenda Roder VIP 10x20 Meter',
                'description' => 'Tenda rangka aluminium kokoh tanpa tiang tengah. Atap blackout kedap panas, cocok untuk pameran akbar, resepsi pernikahan, dan acara formal berkapasitas besar.',
                'photo' => 'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 1,
            ],
            [
                'category' => 'tenda',
                'availability' => 'available',
                'name' => 'Tenda Sarnafil Kerucut 3x3 & 5x5',
                'description' => 'Tenda kerucut bahan tarpaulin premium tahan hujan deras dan angin kencang. Ideal untuk stan bazar, posko informasi, registrasi, dan pameran outdoor.',
                'photo' => 'https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 2,
            ],
            [
                'category' => 'tenda',
                'availability' => 'available',
                'name' => 'Tenda Semi Dekorasi Plafon VIP',
                'description' => 'Tenda lengkung dengan hiasan kain serut plafon kombinasi warna elegan dan lampu gantung. Memberikan suasana hangat dan mewah untuk acara syukuran dan hajatan.',
                'photo' => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 3,
            ],
            [
                'category' => 'tenda',
                'availability' => 'available',
                'name' => 'Flooring Kayu & Karpet Buana',
                'description' => 'Alas lantai kayu tebal dan rata dilapisi karpet buana premium (pilihan warna merah, abu-abu, navy, atau hitam). Nyaman diinjak dan bebas becek saat outdoor.',
                'photo' => 'https://images.unsplash.com/photo-1519710164239-da123dc03ef4?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 4,
            ],
            [
                'category' => 'tenda',
                'availability' => 'limited',
                'name' => 'AC Standing 5 PK & Misty Fan',
                'description' => 'Unit pendingin udara 5 PK untuk tenda tertutup dan kipas kabut embun air bertekanan tinggi untuk menjaga sirkulasi udara tetap sejuk di area outdoor.',
                'photo' => 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 5,
            ],

            // 2. Sound System
            [
                'category' => 'sound',
                'availability' => 'available',
                'name' => 'Sound System 5.000 Watt',
                'description' => 'Paket sound system profesional dengan subwoofer 18 inch, speaker mid-high jernih, equalizer, dan monitor panggung untuk seminar, perpisahan sekolah, dan mini konser.',
                'photo' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 6,
            ],
            [
                'category' => 'sound',
                'availability' => 'available',
                'name' => 'Sound System Konser 10.000 Watt',
                'description' => 'Line array speaker system gantung berkekuatan 10.000 Watt untuk panggung outdoor besar, festival musik, dan perayaan akbar hingga 2.000 penonton.',
                'photo' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 7,
            ],
            [
                'category' => 'sound',
                'availability' => 'available',
                'name' => 'Wireless Microphone UHF Dual Handheld',
                'description' => 'Mikrofon nirkabel dual channel frekuensi UHF anti-interferensi dengan karakter vokal tebal, jernih, dan daya transmisi hingga jarak 80 meter.',
                'photo' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 8,
            ],
            [
                'category' => 'sound',
                'availability' => 'available',
                'name' => 'Mic Clip-On & Headset Wireless',
                'description' => 'Mikrofon jepit kerah (lavalier) dan headset nirkabel sensitivitas tinggi untuk narasumber talkshow, fasilitator workshop, dan moderator panggung.',
                'photo' => 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 9,
            ],
            [
                'category' => 'sound',
                'availability' => 'limited',
                'name' => 'Digital Audio Mixer 32 Channel',
                'description' => 'Konsol mixer audio digital canggih dengan multitrack recording, motorized fader, parametric EQ, serta didampingi sound engineer berpengalaman di lokasi.',
                'photo' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 10,
            ],

            // 3. Lighting & Efek Panggung
            [
                'category' => 'lighting',
                'availability' => 'available',
                'name' => 'Lighting Par LED 54x3W RGBW',
                'description' => 'Lampu sorot wash light LED warna-warni untuk mempercantik backdrop panggung, pencahayaan pohon taman, dan menciptakan ambience sesuai konsep acara.',
                'photo' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 11,
            ],
            [
                'category' => 'lighting',
                'availability' => 'available',
                'name' => 'Moving Head Beam 230W 7R',
                'description' => 'Lampu panggung bergerak dengan berkas sinar tajam (sharp beam), gobo dinamis, dan prisma berputar untuk pertunjukan live musik dan pembukaan acara.',
                'photo' => 'https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 12,
            ],
            [
                'category' => 'lighting',
                'availability' => 'available',
                'name' => 'Follow Spot Light 350W + Stand',
                'description' => 'Lampu sorot fokus terarah berkekuatan tinggi untuk menyorot tamu kehormatan, pembicara utama, atau pengantin saat prosesi kirab berjalan.',
                'photo' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 13,
            ],
            [
                'category' => 'lighting',
                'availability' => 'limited',
                'name' => 'Smoke Machine & Dry Ice Low Fog',
                'description' => 'Mesin pembuat efek kabut tebal melayang di lantai dan asap panggung dramatis untuk momen puncak peresmian, peluncuran produk, dan tarian.',
                'photo' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 14,
            ],

            // 4. Kursi & Meja
            [
                'category' => 'furniture',
                'availability' => 'available',
                'name' => 'Kursi Futura + Cover Ketat & Pita',
                'description' => 'Kursi besi berlapis busa empuk lengkap sarung putih bersih dan pita satin warna sesuai permintaan (merah, emas, navy, hijau, dsb).',
                'photo' => 'https://images.unsplash.com/photo-1503602642458-232111445657?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 15,
            ],
            [
                'category' => 'furniture',
                'availability' => 'limited',
                'name' => 'Kursi Tiffany Putih & Gold VIP',
                'description' => 'Kursi kayu model Tiffany elegan dengan bantalan duduk empuk, sangat digemari untuk jamuan VIP, gala dinner formal, dan resepsi eksklusif.',
                'photo' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 16,
            ],
            [
                'category' => 'furniture',
                'availability' => 'available',
                'name' => 'Meja Bundar Banquet D-180 + Taplak',
                'description' => 'Meja bundar kapasitas 8 hingga 10 orang dengan taplak panjang menyentuh lantai dan table runner mewah untuk jamuan makan resmi tamu penting.',
                'photo' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 17,
            ],
            [
                'category' => 'furniture',
                'availability' => 'available',
                'name' => 'Meja IBM Seminar 45x180 + Skirting',
                'description' => 'Meja panjang lipat multifungsi untuk meja registrasi peserta, meja pemateri seminar, atau meja juri lengkap dengan kain skirting rapi.',
                'photo' => 'https://images.unsplash.com/photo-1517502884422-41eaead166d4?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 18,
            ],

            // 5. Multimedia & Visual
            [
                'category' => 'multimedia',
                'availability' => 'available',
                'name' => 'LED Screen Videotron P3.9 Indoor / Outdoor',
                'description' => 'Layar LED videotron kabinet modular resolusi tajam siang dan malam, video processor seamless switcher, dan konstruksi rigging panggung kokoh.',
                'photo' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 19,
            ],
            [
                'category' => 'multimedia',
                'availability' => 'available',
                'name' => 'Proyektor 5.000 Lumens + Layar 3x4 Meter',
                'description' => 'Paket proyektor laser resolusi Full HD dengan tingkat kecerahan tinggi serta layar lipat rentang besar (fastfold front & rear projection).',
                'photo' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 20,
            ],
            [
                'category' => 'multimedia',
                'availability' => 'available',
                'name' => 'Smart TV 55-65 Inch + Standing Bracket',
                'description' => 'TV display LED resolusi 4K dengan standing bracket dorong beroda. Cocok untuk display stan bazar, monitor waktu pemateri, dan papan pengumuman digital.',
                'photo' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 21,
            ],

            // 6. Daya & Genset
            [
                'category' => 'power',
                'availability' => 'available',
                'name' => 'Genset Silent 10 kVA',
                'description' => 'Generator set dengan peredam suara senyap untuk menyuplai daya sound system, proyektor, dan pencahayaan dasar di lokasi tanpa pasokan PLN memadai.',
                'photo' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 22,
            ],
            [
                'category' => 'power',
                'availability' => 'available',
                'name' => 'Genset Silent 40 kVA Heavy Duty',
                'description' => 'Genset diesel kapasitas besar dengan output daya stabil untuk panggung konser musik, tenda berpendingin AC, videotron, dan sound system besar.',
                'photo' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 23,
            ],
            [
                'category' => 'power',
                'availability' => 'available',
                'name' => 'Kabel Distribusi & Box Panel Listrik',
                'description' => 'Instalasi perkabelan tembaga standar industri, pembagi arus MCB aman dengan proteksi trip, serta rubber cable protector penutup kabel di lantai.',
                'photo' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 24,
            ],

            // 7. Panggung & Perlengkapan Acara
            [
                'category' => 'lainnya',
                'availability' => 'available',
                'name' => 'Panggung Portable Moduler (Tinggi 40 - 100 cm)',
                'description' => 'Rangka panggung besi hollow kokoh berdaya beban tinggi, lantai multiplex tebal dilapisi karpet hitam rapi, dilengkapi tangga naik dan skirting panggung.',
                'photo' => 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 25,
            ],
            [
                'category' => 'lainnya',
                'availability' => 'available',
                'name' => 'Podium Pidato Akrilik Transparan VIP',
                'description' => 'Mimbar pidato modern bahan akrilik bening tebal dengan dudukan mikrofon ganda dan logo instansi custom untuk acara kenegaraan dan peresmian.',
                'photo' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 26,
            ],
            [
                'category' => 'lainnya',
                'availability' => 'unavailable',
                'name' => 'Mojo Barrier Barricade Panggung',
                'description' => 'Pagar pembatas keamanan berbahan besi galvanis kokoh standar festival internasional untuk menjaga jarak aman area panggung dari penonton.',
                'photo' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 27,
            ],
        ];

        foreach ($items as $item) {
            RentalItem::updateOrCreate(
                [
                    'service_id' => $rentalService->id,
                    'name' => $item['name'],
                ],
                $item + [
                    'price_per_day' => $item['price_per_day'] ?? match ($item['category']) {
                        'tenda' => 1500000,
                        'sound' => 1000000,
                        'lighting' => 750000,
                        'furniture' => 250000,
                        'multimedia' => 850000,
                        'power' => 900000,
                        default => 500000,
                    },
                    'is_active' => true,
                ]
            );
        }
    }
}
