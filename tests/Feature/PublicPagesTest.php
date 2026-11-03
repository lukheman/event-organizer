<?php

use App\Models\Collaboration;
use App\Models\RentalItem;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Database\Seeders\RentalCatalogSeeder;

it('shows public event organizer pages', function () {
    $this->get('/')->assertSuccessful()->assertSee('Sewa perlengkapan acara, lengkap dan siap pakai.');
    $this->get('/tentang')->assertSuccessful()->assertSee('Tentang kami');
    $this->get('/layanan')->assertSuccessful()->assertSee('Layanan');
    $this->get('/kontak')->assertSuccessful()->assertSee('Mari bicarakan acara Anda.');
});

it('shows available event packages on package service detail', function () {
    Service::updateOrCreate(['slug' => 'paket-event'], [
        'category' => 'paket',
        'name' => 'Paket Event',
        'slug' => 'paket-event',
        'description' => 'Paket event sesuai kebutuhan acara.',
        'features' => ['Koordinasi satu pintu'],
        'is_active' => true,
    ]);

    $this->get('/layanan/paket-event')
        ->assertSuccessful()
        ->assertSee('Pilih paket yang sesuai acara Anda.')
        ->assertSee('Paket Intimate')
        ->assertSee('Paket Professional')
        ->assertSee('Paket Custom')
        ->assertSee('Pilih paket ini');
});

it('shows rental catalog with live items and whatsapp cta', function () {
    SiteSetting::create(['key' => 'whatsapp_number', 'value' => '628111222333']);
    SocialLink::create(['platform' => 'Instagram', 'url' => 'https://instagram.com/nusaevent', 'icon' => 'fa-brands fa-instagram', 'sort_order' => 1]);

    $rentalService = Service::factory()->create([
        'category' => 'penyewaan',
        'name' => 'Sewa Alat',
        'slug' => 'sewa-alat',
    ]);
    $item = RentalItem::create([
        'service_id' => $rentalService->id,
        'category' => 'sound',
        'availability' => 'limited',
        'name' => 'Sound System Test',
        'description' => 'Sound system untuk acara.',
        'sort_order' => 1,
        'is_active' => true,
    ]);
    $collaboration = Collaboration::create([
        'partner_name' => 'PT Contoh',
        'event_name' => 'Seminar Contoh',
        'slug' => 'seminar-contoh',
        'event_date' => now(),
        'description' => 'Kegiatan contoh.',
    ]);
    $testimonial = Testimonial::create([
        'name' => 'Sari Contoh',
        'organization' => 'Instansi Contoh',
        'comment' => 'Peralatan lengkap dan datang tepat waktu.',
        'rating' => 5,
    ]);

    $this->get('/')
        ->assertSuccessful()
        ->assertSee('Pilih alat, cek jadwal, kami antar.')
        ->assertSee('Alat kami sudah mendukung berbagai acara')
        ->assertSee('Kata mereka yang sudah menyewa')
        ->assertSee($item->name)
        ->assertSee('Sound System')
        ->assertSee($collaboration->event_name)
        ->assertSee($testimonial->name)
        ->assertSee('Instagram')
        ->assertSee('Terbatas')
        ->assertSee('Cek stok terbatas')
        ->assertSee('wa.me/628111222333', false)
        ->assertSee('Sound+System+Test', false);
});

it('shows availability status for each rental item', function () {
    $rentalService = Service::factory()->create(['category' => 'penyewaan', 'slug' => 'sewa-alat']);

    foreach ([
        ['key' => 'available', 'name' => 'Item Tersedia Uji'],
        ['key' => 'limited', 'name' => 'Item Terbatas Uji'],
        ['key' => 'unavailable', 'name' => 'Item Kosong Uji'],
    ] as $index => $data) {
        RentalItem::create([
            'service_id' => $rentalService->id,
            'category' => 'tenda',
            'availability' => $data['key'],
            'name' => $data['name'],
            'sort_order' => $index + 1,
            'is_active' => true,
        ]);
    }

    $this->get('/')
        ->assertSuccessful()
        ->assertSee('Item Tersedia Uji')
        ->assertSee('Tersedia')
        ->assertSee('Item Terbatas Uji')
        ->assertSee('Cek stok terbatas')
        ->assertSee('Item Kosong Uji')
        ->assertSee('Tidak tersedia')
        ->assertSee('Tanya jadwal berikutnya');
});

it('renders dummy rental image assets when no upload is available', function () {
    $rentalService = Service::factory()->create(['category' => 'penyewaan', 'slug' => 'sewa-alat']);
    RentalItem::create([
        'service_id' => $rentalService->id,
        'category' => 'tenda',
        'name' => 'Tenda Dummy',
        'photo' => 'dummy-rental/tenda.svg',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $this->get('/')
        ->assertSuccessful()
        ->assertSee('/assets/dummy-rental/tenda.svg', false);
});

it('hides inactive rental items from the public catalog', function () {
    $rentalService = Service::factory()->create(['category' => 'penyewaan', 'slug' => 'sewa-alat']);
    RentalItem::create([
        'service_id' => $rentalService->id,
        'category' => 'tenda',
        'name' => 'Tenda Tersembunyi',
        'sort_order' => 1,
        'is_active' => false,
    ]);

    $this->get('/')->assertSuccessful()->assertDontSee('Tenda Tersembunyi');
});

it('shows service detail by slug', function () {
    $service = Service::factory()->create(['slug' => 'event-test', 'name' => 'Event Test', 'is_active' => true]);

    $this->get(route('services.show', $service))->assertSuccessful()->assertSee('Event Test');
});

it('shows team members on about page', function () {
    TeamMember::create([
        'name' => 'Budi Santoso',
        'position' => 'Event Coordinator',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $this->get(route('about'))
        ->assertSuccessful()
        ->assertSee('Budi Santoso')
        ->assertSee('Event Coordinator');
});

it('shows rental item detail page with booking form', function () {
    $rentalService = Service::factory()->create(['category' => 'penyewaan', 'slug' => 'sewa-alat']);
    $item = RentalItem::create([
        'service_id' => $rentalService->id,
        'category' => 'sound',
        'availability' => 'available',
        'name' => 'Sound System Konser',
        'description' => 'Sound system outdoor.',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $this->get(route('rental-items.show', $item))
        ->assertSuccessful()
        ->assertSee('Sound System Konser')
        ->assertSee('Booking via WhatsApp');
});

it('shows the custom requirement builder with rental items and crew selection', function () {
    SiteSetting::create(['key' => 'whatsapp_number', 'value' => '628111222333']);

    $rentalService = Service::factory()->create(['category' => 'penyewaan', 'slug' => 'sewa-alat']);
    RentalItem::create([
        'service_id' => $rentalService->id,
        'category' => 'sound',
        'availability' => 'available',
        'name' => 'Sound System Rancangan',
        'description' => 'Sound system untuk rancangan acara.',
        'price_per_day' => 750000,
        'sort_order' => 1,
        'is_active' => true,
    ]);
    RentalItem::create([
        'service_id' => $rentalService->id,
        'category' => 'tenda',
        'name' => 'Tenda Tersembunyi Rancangan',
        'sort_order' => 2,
        'is_active' => false,
    ]);
    Service::updateOrCreate(['slug' => 'sewa-crew'], [
        'category' => 'sewa-crew',
        'name' => 'Sewa Crew',
        'description' => 'Crew profesional untuk operasional acara.',
        'features' => ['Crew berpengalaman', 'Koordinasi acara'],
        'is_active' => true,
    ]);

    $this->get(route('custom'))
        ->assertSuccessful()
        ->assertSee('Susun kebutuhan acara Anda.')
        ->assertSee('Pilih alat yang ingin disewa')
        ->assertSee('Butuh berapa crew?')
        ->assertSee('Sound System Rancangan')
        ->assertSee('Rp 750.000 / hari')
        ->assertSee('Crew berpengalaman')
        ->assertSee('Kirim Rencana ke WhatsApp')
        ->assertSee('wa.me/628111222333', false)
        ->assertDontSee('Tenda Tersembunyi Rancangan');
});

it('generates dynamic sitemap.xml', function () {
    $response = $this->get('/sitemap.xml');

    $response->assertSuccessful();
    $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
    expect($response->getContent())->toContain('<urlset')
        ->and($response->getContent())->toContain(route('home'))
        ->and($response->getContent())->toContain(route('about'))
        ->and($response->getContent())->toContain(route('custom'));
});

it('seeds rich rental items across all categories', function () {
    $this->seed(RentalCatalogSeeder::class);

    $this->get('/')
        ->assertSuccessful()
        ->assertSee('Tenda Roder VIP')
        ->assertSee('Sound System 5.000 Watt')
        ->assertSee('Moving Head Beam')
        ->assertSee('Kursi Futura')
        ->assertSee('LED Screen Videotron')
        ->assertSee('Genset Silent')
        ->assertSee('Panggung Portable Moduler');
});
