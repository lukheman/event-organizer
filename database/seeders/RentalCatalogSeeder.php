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
                'photo' => 'dummy-rental/tenda-roder.svg',
                'sort_order' => 1,
            ],
            [
                'category' => 'tenda',
                'availability' => 'available',
                'name' => 'Tenda Sarnafil Kerucut 3x3 & 5x5',
                'description' => 'Tenda kerucut bahan tarpaulin premium tahan hujan deras dan angin kencang. Ideal untuk stan bazar, posko informasi, registrasi, dan pameran outdoor.',
                'photo' => 'dummy-rental/tenda-sarnafil.svg',
                'sort_order' => 2,
            ],
            [
                'category' => 'tenda',
                'availability' => 'available',
                'name' => 'Tenda Semi Dekorasi Plafon VIP',
                'description' => 'Tenda lengkung dengan hiasan kain serut plafon kombinasi warna elegan dan lampu gantung. Memberikan suasana hangat dan mewah untuk acara syukuran dan hajatan.',
                'photo' => 'dummy-rental/tenda.svg',
                'sort_order' => 3,
            ],
            [
                'category' => 'tenda',
                'availability' => 'available',
                'name' => 'Flooring Kayu & Karpet Buana',
                'description' => 'Alas lantai kayu tebal dan rata dilapisi karpet buana premium (pilihan warna merah, abu-abu, navy, atau hitam). Nyaman diinjak dan bebas becek saat outdoor.',
                'photo' => 'dummy-rental/tenda.svg',
                'sort_order' => 4,
            ],
            [
                'category' => 'tenda',
                'availability' => 'limited',
                'name' => 'AC Standing 5 PK & Misty Fan',
                'description' => 'Unit pendingin udara 5 PK untuk tenda tertutup dan kipas kabut embun air bertekanan tinggi untuk menjaga sirkulasi udara tetap sejuk di area outdoor.',
                'photo' => 'dummy-rental/power.svg',
                'sort_order' => 5,
            ],

            // 2. Sound System
            [
                'category' => 'sound',
                'availability' => 'available',
                'name' => 'Sound System 5.000 Watt',
                'description' => 'Paket sound system profesional dengan subwoofer 18 inch, speaker mid-high jernih, equalizer, dan monitor panggung untuk seminar, perpisahan sekolah, dan mini konser.',
                'photo' => 'dummy-rental/sound-system.svg',
                'sort_order' => 6,
            ],
            [
                'category' => 'sound',
                'availability' => 'available',
                'name' => 'Sound System Konser 10.000 Watt',
                'description' => 'Line array speaker system gantung berkekuatan 10.000 Watt untuk panggung outdoor besar, festival musik, dan perayaan akbar hingga 2.000 penonton.',
                'photo' => 'dummy-rental/sound-system.svg',
                'sort_order' => 7,
            ],
            [
                'category' => 'sound',
                'availability' => 'available',
                'name' => 'Wireless Microphone UHF Dual Handheld',
                'description' => 'Mikrofon nirkabel dual channel frekuensi UHF anti-interferensi dengan karakter vokal tebal, jernih, dan daya transmisi hingga jarak 80 meter.',
                'photo' => 'dummy-rental/wireless-microphone.svg',
                'sort_order' => 8,
            ],
            [
                'category' => 'sound',
                'availability' => 'available',
                'name' => 'Mic Clip-On & Headset Wireless',
                'description' => 'Mikrofon jepit kerah (lavalier) dan headset nirkabel sensitivitas tinggi untuk narasumber talkshow, fasilitator workshop, dan moderator panggung.',
                'photo' => 'dummy-rental/wireless-microphone.svg',
                'sort_order' => 9,
            ],
            [
                'category' => 'sound',
                'availability' => 'limited',
                'name' => 'Digital Audio Mixer 32 Channel',
                'description' => 'Konsol mixer audio digital canggih dengan multitrack recording, motorized fader, parametric EQ, serta didampingi sound engineer berpengalaman di lokasi.',
                'photo' => 'dummy-rental/sound.svg',
                'sort_order' => 10,
            ],

            // 3. Lighting & Efek Panggung
            [
                'category' => 'lighting',
                'availability' => 'available',
                'name' => 'Lighting Par LED 54x3W RGBW',
                'description' => 'Lampu sorot wash light LED warna-warni untuk mempercantik backdrop panggung, pencahayaan pohon taman, dan menciptakan ambience sesuai konsep acara.',
                'photo' => 'dummy-rental/lighting-par-led.svg',
                'sort_order' => 11,
            ],
            [
                'category' => 'lighting',
                'availability' => 'available',
                'name' => 'Moving Head Beam 230W 7R',
                'description' => 'Lampu panggung bergerak dengan berkas sinar tajam (sharp beam), gobo dinamis, dan prisma berputar untuk pertunjukan live musik dan pembukaan acara.',
                'photo' => 'dummy-rental/moving-head.svg',
                'sort_order' => 12,
            ],
            [
                'category' => 'lighting',
                'availability' => 'available',
                'name' => 'Follow Spot Light 350W + Stand',
                'description' => 'Lampu sorot fokus terarah berkekuatan tinggi untuk menyorot tamu kehormatan, pembicara utama, atau pengantin saat prosesi kirab berjalan.',
                'photo' => 'dummy-rental/lighting.svg',
                'sort_order' => 13,
            ],
            [
                'category' => 'lighting',
                'availability' => 'limited',
                'name' => 'Smoke Machine & Dry Ice Low Fog',
                'description' => 'Mesin pembuat efek kabut tebal melayang di lantai dan asap panggung dramatis untuk momen puncak peresmian, peluncuran produk, dan tarian.',
                'photo' => 'dummy-rental/lainnya.svg',
                'sort_order' => 14,
            ],

            // 4. Kursi & Meja
            [
                'category' => 'furniture',
                'availability' => 'available',
                'name' => 'Kursi Futura + Cover Ketat & Pita',
                'description' => 'Kursi besi berlapis busa empuk lengkap sarung putih bersih dan pita satin warna sesuai permintaan (merah, emas, navy, hijau, dsb).',
                'photo' => 'dummy-rental/kursi-futura.svg',
                'sort_order' => 15,
            ],
            [
                'category' => 'furniture',
                'availability' => 'limited',
                'name' => 'Kursi Tiffany Putih & Gold VIP',
                'description' => 'Kursi kayu model Tiffany elegan dengan bantalan duduk empuk, sangat digemari untuk jamuan VIP, gala dinner formal, dan resepsi eksklusif.',
                'photo' => 'dummy-rental/kursi-futura.svg',
                'sort_order' => 16,
            ],
            [
                'category' => 'furniture',
                'availability' => 'available',
                'name' => 'Meja Bundar Banquet D-180 + Taplak',
                'description' => 'Meja bundar kapasitas 8 hingga 10 orang dengan taplak panjang menyentuh lantai dan table runner mewah untuk jamuan makan resmi tamu penting.',
                'photo' => 'dummy-rental/meja-bundar.svg',
                'sort_order' => 17,
            ],
            [
                'category' => 'furniture',
                'availability' => 'available',
                'name' => 'Meja IBM Seminar 45x180 + Skirting',
                'description' => 'Meja panjang lipat multifungsi untuk meja registrasi peserta, meja pemateri seminar, atau meja juri lengkap dengan kain skirting rapi.',
                'photo' => 'dummy-rental/furniture.svg',
                'sort_order' => 18,
            ],

            // 5. Multimedia & Visual
            [
                'category' => 'multimedia',
                'availability' => 'available',
                'name' => 'LED Screen Videotron P3.9 Indoor / Outdoor',
                'description' => 'Layar LED videotron kabinet modular resolusi tajam siang dan malam, video processor seamless switcher, dan konstruksi rigging panggung kokoh.',
                'photo' => 'dummy-rental/led-screen.svg',
                'sort_order' => 19,
            ],
            [
                'category' => 'multimedia',
                'availability' => 'available',
                'name' => 'Proyektor 5.000 Lumens + Layar 3x4 Meter',
                'description' => 'Paket proyektor laser resolusi Full HD dengan tingkat kecerahan tinggi serta layar lipat rentang besar (fastfold front & rear projection).',
                'photo' => 'dummy-rental/proyektor-layar.svg',
                'sort_order' => 20,
            ],
            [
                'category' => 'multimedia',
                'availability' => 'available',
                'name' => 'Smart TV 55-65 Inch + Standing Bracket',
                'description' => 'TV display LED resolusi 4K dengan standing bracket dorong beroda. Cocok untuk display stan bazar, monitor waktu pemateri, dan papan pengumuman digital.',
                'photo' => 'dummy-rental/multimedia.svg',
                'sort_order' => 21,
            ],

            // 6. Daya & Genset
            [
                'category' => 'power',
                'availability' => 'available',
                'name' => 'Genset Silent 10 kVA',
                'description' => 'Generator set dengan peredam suara senyap untuk menyuplai daya sound system, proyektor, dan pencahayaan dasar di lokasi tanpa pasokan PLN memadai.',
                'photo' => 'dummy-rental/genset.svg',
                'sort_order' => 22,
            ],
            [
                'category' => 'power',
                'availability' => 'available',
                'name' => 'Genset Silent 40 kVA Heavy Duty',
                'description' => 'Genset diesel kapasitas besar dengan output daya stabil untuk panggung konser musik, tenda berpendingin AC, videotron, dan sound system besar.',
                'photo' => 'dummy-rental/genset.svg',
                'sort_order' => 23,
            ],
            [
                'category' => 'power',
                'availability' => 'available',
                'name' => 'Kabel Distribusi & Box Panel Listrik',
                'description' => 'Instalasi perkabelan tembaga standar industri, pembagi arus MCB aman dengan proteksi trip, serta rubber cable protector penutup kabel di lantai.',
                'photo' => 'dummy-rental/power.svg',
                'sort_order' => 24,
            ],

            // 7. Panggung & Perlengkapan Acara
            [
                'category' => 'lainnya',
                'availability' => 'available',
                'name' => 'Panggung Portable Moduler (Tinggi 40 - 100 cm)',
                'description' => 'Rangka panggung besi hollow kokoh berdaya beban tinggi, lantai multiplex tebal dilapisi karpet hitam rapi, dilengkapi tangga naik dan skirting panggung.',
                'photo' => 'dummy-rental/panggung-portable.svg',
                'sort_order' => 25,
            ],
            [
                'category' => 'lainnya',
                'availability' => 'available',
                'name' => 'Podium Pidato Akrilik Transparan VIP',
                'description' => 'Mimbar pidato modern bahan akrilik bening tebal dengan dudukan mikrofon ganda dan logo instansi custom untuk acara kenegaraan dan peresmian.',
                'photo' => 'dummy-rental/lainnya.svg',
                'sort_order' => 26,
            ],
            [
                'category' => 'lainnya',
                'availability' => 'unavailable',
                'name' => 'Mojo Barrier Barricade Panggung',
                'description' => 'Pagar pembatas keamanan berbahan besi galvanis kokoh standar festival internasional untuk menjaga jarak aman area panggung dari penonton.',
                'photo' => 'dummy-rental/lainnya.svg',
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
