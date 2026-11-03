<x-layouts.app :title="($record ? 'Edit ' : 'Tambah ').$config['title'].' - Admin'">
    <x-layout.page-header :title="($record ? 'Edit ' : 'Tambah ').$config['title']" subtitle="Perubahan akan langsung tampil di website." />

    <x-layout.modern-card>
        <form method="POST" enctype="multipart/form-data" action="{{ $record ? route('admin.content.update', [$resource, $record->id]) : route('admin.content.store', $resource) }}">
            @csrf
            @if ($record)
                @method('PUT')
            @endif

            <div class="row g-3">
                @if ($resource === 'rental-items')
                    <div class="col-md-6">
                        <label class="form-label" for="rental-service">Layanan Penyewaan</label>
                        <select id="rental-service" name="service_id" class="form-select" required>
                            @foreach ($rentalServices as $rentalService)
                                <option value="{{ $rentalService->id }}" @selected((int) old('service_id', $record?->service_id) === $rentalService->id)>{{ $rentalService->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="rental-category">Kategori Alat</label>
                        <select id="rental-category" name="category" class="form-select">
                            <option value="">Pilih kategori</option>
                            @foreach (config('rental.categories') as $value => $label)
                                <option value="{{ $value }}" @selected(old('category', $record?->category) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label" for="rental-name">Nama Item</label>
                        <input id="rental-name" name="name" class="form-control" value="{{ old('name', $record?->name) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="rental-order">Urutan</label>
                        <input id="rental-order" type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $record?->sort_order ?? 0) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="rental-price">Harga Sewa per Hari (Rp)</label>
                        <input id="rental-price" type="number" name="price_per_day" class="form-control" min="0" step="1000" value="{{ old('price_per_day', $record?->price_per_day) }}" placeholder="Contoh: 1500000">
                        <div class="form-text">Kosongkan jika harga berdasarkan kebutuhan.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="rental-availability">Status Ketersediaan</label>
                        <select id="rental-availability" name="availability" class="form-select" required>
                            @foreach (config('rental.availability') as $value => $meta)
                                <option value="{{ $value }}" @selected(old('availability', $record?->availability ?? 'available') === $value)>{{ $meta['label'] }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Tampil sebagai badge di katalog publik.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="rental-description">Deskripsi</label>
                        <textarea id="rental-description" name="description" class="form-control" rows="3">{{ old('description', $record?->description) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="rental-photo">Foto Item</label>
                        <input id="rental-photo" type="file" name="photo" class="form-control" accept="image/*">
                        <div class="form-text">JPG, PNG, atau WebP. Maksimal 2 MB.</div>
                        @error('photo')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        @if ($record?->photoUrl())
                            <img src="{{ $record->photoUrl() }}" alt="{{ $record->name }}" class="rounded" style="width: 100%; max-width: 220px; height: 120px; object-fit: cover;">
                        @endif
                    </div>
                @elseif ($resource === 'services')
                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <select name="category" class="form-select" required>
                            @foreach (['wedding' => 'Wedding', 'workshop' => 'Workshop', 'seminar' => 'Seminar', 'sewa-crew' => 'Sewa Crew', 'paket' => 'Paket Event', 'penyewaan' => 'Penyewaan'] as $category => $label)
                                <option value="{{ $category }}" @selected(old('category', $record?->category) === $category)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input name="name" class="form-control" value="{{ old('name', $record?->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input name="slug" class="form-control" value="{{ old('slug', $record?->slug) }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $record?->description) }}</textarea>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Fasilitas (satu per baris)</label>
                        <textarea name="features" class="form-control" rows="4">{{ old('features', implode("\n", $record?->features ?? [])) }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $record?->sort_order ?? 0) }}">
                    </div>
                @elseif ($resource === 'collaborations')
                    <div class="col-md-6">
                        <label class="form-label">Nama Mitra</label>
                        <input name="partner_name" class="form-control" value="{{ old('partner_name', $record?->partner_name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Kegiatan</label>
                        <input name="event_name" class="form-control" value="{{ old('event_name', $record?->event_name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input name="slug" class="form-control" value="{{ old('slug', $record?->slug) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="event_date" class="form-control" value="{{ old('event_date', $record?->event_date?->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kategori Layanan</label>
                        <select name="service_category" class="form-select">
                            <option value="">Pilih kategori (opsional)</option>
                            <option value="wedding" @selected(old('service_category', $record?->service_category) === 'wedding')>Wedding</option>
                            <option value="workshop" @selected(old('service_category', $record?->service_category) === 'workshop')>Workshop</option>
                            <option value="seminar" @selected(old('service_category', $record?->service_category) === 'seminar')>Seminar</option>
                            <option value="sewa-crew" @selected(old('service_category', $record?->service_category) === 'sewa-crew')>Sewa Crew</option>
                            <option value="paket" @selected(old('service_category', $record?->service_category) === 'paket')>Paket Event</option>
                            <option value="penyewaan" @selected(old('service_category', $record?->service_category) === 'penyewaan')>Penyewaan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Unggah Foto Dokumentasi (Bisa pilih beberapa)</label>
                        <input type="file" name="photos[]" class="form-control" accept="image/*" multiple>
                        <div class="form-text">JPG, PNG, atau WebP. Maksimal 2 MB per file.</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $record?->description) }}</textarea>
                    </div>
                    @if ($record && $record->photos->isNotEmpty())
                        <div class="col-12 mt-3">
                            <label class="form-label fw-bold">Galeri Foto Saat Ini</label>
                            <div class="row g-3">
                                @foreach ($record->photos as $photo)
                                    <div class="col-6 col-md-3">
                                        <div class="card p-2 text-center position-relative h-100">
                                            <div class="ratio ratio-4x3 rounded overflow-hidden mb-2">
                                                <img src="{{ $photo->photoUrl() }}" alt="{{ $photo->caption }}" class="w-100 h-100" style="object-fit: cover;">
                                            </div>
                                            <small class="text-muted d-block text-truncate">{{ $photo->caption ?: 'Foto dokumentasi' }}</small>
                                            <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="if(confirm('Hapus foto ini?')) document.getElementById('delete-photo-{{ $photo->id }}').submit();">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @elseif ($resource === 'testimonials')
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input name="name" class="form-control" value="{{ old('name', $record?->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Instansi / Jabatan</label>
                        <input name="organization" class="form-control" value="{{ old('organization', $record?->organization) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Komentar</label>
                        <textarea name="comment" class="form-control" rows="4" required>{{ old('comment', $record?->comment) }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Rating</label>
                        <input type="number" min="1" max="5" name="rating" class="form-control" value="{{ old('rating', $record?->rating) }}">
                    </div>
                @elseif ($resource === 'team-members')
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input name="name" class="form-control" value="{{ old('name', $record?->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jabatan / Posisi</label>
                        <input name="position" class="form-control" value="{{ old('position', $record?->position) }}" placeholder="Contoh: Project Director" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Foto Anggota Tim</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                        <div class="form-text">JPG, PNG, atau WebP. Maksimal 2 MB.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $record?->sort_order ?? 0) }}">
                    </div>
                    @if ($record?->photoUrl())
                        <div class="col-12">
                            <img src="{{ $record->photoUrl() }}" alt="{{ $record->name }}" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                    @endif
                @else
                    <div class="col-md-6">
                        <label class="form-label">Platform</label>
                        <input name="platform" class="form-control" value="{{ old('platform', $record?->platform) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">URL</label>
                        <input type="url" name="url" class="form-control" value="{{ old('url', $record?->url) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Icon FontAwesome</label>
                        <input name="icon" class="form-control" value="{{ old('icon', $record?->icon) }}" placeholder="fa-brands fa-instagram">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $record?->sort_order ?? 0) }}">
                    </div>
                @endif

                <div class="col-12">
                    <div class="form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is-active" @checked(old('is_active', $record?->is_active ?? true))>
                        <label class="form-check-label" for="is-active">Tampilkan di website</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Simpan</button>
                <a class="btn btn-light" href="{{ route('admin.content.index', $resource) }}">Batal</a>
            </div>
        </form>
    </x-layout.modern-card>

    @if ($record && $resource === 'collaborations' && $record->photos->isNotEmpty())
        @foreach ($record->photos as $photo)
            <form id="delete-photo-{{ $photo->id }}" method="POST" action="{{ route('admin.content.photos.destroy', $photo->id) }}" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    @endif
</x-layouts.app>
