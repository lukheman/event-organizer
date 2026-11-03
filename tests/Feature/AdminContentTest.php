<?php

use App\Models\Collaboration;
use App\Models\CollaborationPhoto;
use App\Models\RentalItem;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('protects content management behind authentication', function () {
    $this->get(route('admin.content.index', 'services'))->assertRedirect(route('login'));
});

it('allows admin to create and delete a service', function () {
    $this->actingAs(User::factory()->create());

    $this->post(route('admin.content.store', 'services'), [
        'category' => 'workshop',
        'name' => 'Workshop Kreatif',
        'slug' => 'workshop-kreatif',
        'description' => 'Workshop untuk tim.',
        'features' => "Fasilitator\nModul",
        'sort_order' => 1,
        'is_active' => 1,
    ])->assertRedirect(route('admin.content.index', 'services'));

    $service = Service::query()->where('slug', 'workshop-kreatif')->firstOrFail();
    expect($service->features)->toBe(['Fasilitator', 'Modul']);

    $this->delete(route('admin.content.destroy', ['resource' => 'services', 'id' => $service->id]))
        ->assertRedirect();

    expect(Service::find($service->id))->toBeNull();
});

it('renders rental item management pages for admins', function () {
    Service::factory()->create(['category' => 'penyewaan', 'slug' => 'sewa-alat']);

    $this->actingAs(User::factory()->create())
        ->get(route('admin.content.index', 'rental-items'))
        ->assertOk()
        ->assertSee('Item Sewa');

    $this->get(route('admin.content.create', 'rental-items'))
        ->assertOk()
        ->assertSee('Kategori Alat')
        ->assertSee('Status Ketersediaan')
        ->assertSee('Foto Item')
        ->assertSee('Tampilkan di website');
});

it('allows admin to create a rental item with a photo', function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());

    $rentalService = Service::factory()->create(['category' => 'penyewaan', 'slug' => 'sewa-alat']);

    $this->post(route('admin.content.store', 'rental-items'), [
        'service_id' => $rentalService->id,
        'category' => 'sound',
        'availability' => 'limited',
        'name' => 'Sound System Baru',
        'description' => 'Paket sound untuk acara.',
        'photo' => UploadedFile::fake()->image('sound.jpg'),
        'sort_order' => 1,
        'is_active' => 1,
    ])->assertRedirect(route('admin.content.index', 'rental-items'));

    $item = RentalItem::query()->where('name', 'Sound System Baru')->firstOrFail();

    expect($item->is_active)->toBeTrue()
        ->and($item->category)->toBe('sound')
        ->and($item->availability)->toBe('limited')
        ->and($item->availabilityLabel())->toBe('Terbatas');

    Storage::disk('public')->assertExists($item->photo);
    $this->get('/')->assertSuccessful()->assertSee('Sound System Baru')->assertSee('Terbatas');
});

it('allows admin to update rental availability status', function () {
    $this->actingAs(User::factory()->create());

    $rentalService = Service::factory()->create(['category' => 'penyewaan', 'slug' => 'sewa-alat']);
    $item = RentalItem::create([
        'service_id' => $rentalService->id,
        'category' => 'tenda',
        'availability' => 'available',
        'name' => 'Tenda Status',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $this->put(route('admin.content.update', ['resource' => 'rental-items', 'id' => $item->id]), [
        'service_id' => $rentalService->id,
        'category' => 'tenda',
        'availability' => 'unavailable',
        'name' => 'Tenda Status',
        'description' => 'Sedang dalam perawatan.',
        'sort_order' => 1,
        'is_active' => 1,
    ])->assertRedirect(route('admin.content.index', 'rental-items'));

    expect($item->fresh()->availability)->toBe('unavailable');

    $this->get('/')->assertSuccessful()->assertSee('Tidak tersedia')->assertSee('Tanya jadwal berikutnya');
});

it('allows admin to manage team members', function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());

    $this->post(route('admin.content.store', 'team-members'), [
        'name' => 'Aditya Pratama',
        'position' => 'Technical Director',
        'photo' => UploadedFile::fake()->image('aditya.jpg'),
        'sort_order' => 1,
        'is_active' => 1,
    ])->assertRedirect(route('admin.content.index', 'team-members'));

    $member = TeamMember::where('name', 'Aditya Pratama')->firstOrFail();
    expect($member->position)->toBe('Technical Director')
        ->and($member->is_active)->toBeTrue();

    Storage::disk('public')->assertExists($member->photo);

    $this->get(route('about'))
        ->assertSuccessful()
        ->assertSee('Aditya Pratama')
        ->assertSee('Technical Director');
});

it('allows admin to upload and delete collaboration photos', function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());

    $this->post(route('admin.content.store', 'collaborations'), [
        'partner_name' => 'Universitas Indonesia',
        'event_name' => 'Seminar Nasional 2026',
        'slug' => 'seminar-nasional-2026',
        'event_date' => '2026-05-10',
        'service_category' => 'seminar',
        'description' => 'Seminar dengan 500 peserta.',
        'photos' => [
            UploadedFile::fake()->image('photo1.jpg'),
            UploadedFile::fake()->image('photo2.jpg'),
        ],
        'is_active' => 1,
    ])->assertRedirect(route('admin.content.index', 'collaborations'));

    $collab = Collaboration::where('slug', 'seminar-nasional-2026')->firstOrFail();
    expect($collab->photos()->count())->toBe(2);

    $photoToDelete = $collab->photos()->first();
    Storage::disk('public')->assertExists($photoToDelete->photo_path);

    $this->delete(route('admin.content.photos.destroy', $photoToDelete->id))
        ->assertRedirect();

    expect(CollaborationPhoto::find($photoToDelete->id))->toBeNull();
    Storage::disk('public')->assertMissing($photoToDelete->photo_path);
});
