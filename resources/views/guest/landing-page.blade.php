@php
    $heroEyebrow = $settings['hero_eyebrow'] ?? 'Event organizer profesional';
    $heroTitle = $settings['hero_title'] ?? 'Wujudkan acara yang terencana, berkesan, dan berjalan tanpa hambatan.';
    $heroSubtitle = $settings['hero_subtitle'] ?? 'Lini Jaya Event membantu Anda merancang konsep, mengelola produksi, dan menyediakan perlengkapan untuk setiap kebutuhan acara.';
    $waUrl = \App\Support\SiteContent::whatsappUrl($settings);
    $categoryLabels = config('rental.categories');

    // Gunakan foto dokumentasi (selain cover) lebih dulu agar tidak sama dengan kartu portofolio.
    $heroSlides = $collaborations
        ->flatMap(fn ($collaboration) => $collaboration->photos->skip(1)->map(fn ($photo) => $photo->photoUrl()))
        ->merge($collaborations->map(fn ($collaboration) => $collaboration->coverUrl()))
        ->filter()
        ->unique()
        ->take(3)
        ->map(fn ($url) => str_replace('w=1200', 'w=1920', $url))
        ->values();
@endphp

<x-layouts.public
    :title="($settings['site_name'] ?? 'Lini Jaya Event').' — Event Organizer Profesional'"
    description="Event organizer profesional untuk perencanaan, produksi, pelaksanaan acara, dan penyediaan perlengkapan event."
    :settings="$settings"
>
    <section class="hero hero-with-slider">
        @if ($heroSlides->isNotEmpty())
            <div id="heroSlider" class="carousel slide carousel-fade hero-slider" data-bs-ride="carousel" data-bs-interval="5500">
                <div class="carousel-inner">
                    @foreach ($heroSlides as $index => $slide)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="hero-slide" style="background-image: url('{{ $slide }}');"></div>
                        </div>
                    @endforeach
                </div>

                @if ($heroSlides->count() > 1)
                    <div class="carousel-indicators">
                        @foreach ($heroSlides as $index => $slide)
                            <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Tampilkan gambar {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-12">
                    <div class="hero-copy">
                     <span class="eyebrow d-inline-block mb-3">{{ $heroEyebrow }}</span>
                     <h1 class="display-3 mb-3">{{ $heroTitle }}</h1>
                     <p class="lead text-secondary mb-4">{{ $heroSubtitle }}</p>

                     <div class="d-flex flex-wrap gap-2 mb-4">
                         <a class="btn btn-main" href="#layanan">
                             <i class="fa-solid fa-calendar-check me-1"></i> Lihat layanan kami
                         </a>
                        <a class="btn btn-ghost" href="{{ $waUrl }}" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp me-1"></i> Konsultasi via WhatsApp
                        </a>
                    </div>

                    <p class="small text-secondary mb-4">
                         <i class="fa-solid fa-circle-check me-1" style="color: var(--color-secondary)"></i>
                         {{ $settings['hero_note'] ?? 'Dari konsep hingga eksekusi, satu tim untuk acara Anda.' }}
                    </p>

                    <div class="d-flex flex-wrap gap-4">
                         <div>
                             <div class="stat-value">{{ $stats['services'] }}</div>
                             <div class="small text-secondary">Layanan event</div>
                         </div>
                         <div>
                             <div class="stat-value">{{ $stats['collaborations'] }}</div>
                             <div class="small text-secondary">Acara ditangani</div>
                         </div>
                         <div>
                             <div class="stat-value">{{ $stats['partners'] }}</div>
                             <div class="small text-secondary">Mitra kerja sama</div>
                         </div>
                         <div>
                             <div class="stat-value">{{ $stats['available_items'] }}</div>
                             <div class="small text-secondary">Perlengkapan siap</div>
                         </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="section section-soft" id="layanan">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
                <div class="section-head">
                    <span class="eyebrow">Layanan event organizer</span>
                    <h2 class="display-6 mt-2 mb-2">Satu partner untuk seluruh kebutuhan acara.</h2>
                    <p class="text-secondary mb-0">Mulai dari ide, perencanaan, produksi, sampai evaluasi. Tim kami siap mengelola detail agar Anda bisa fokus pada tujuan acara.</p>
                </div>
                <a class="text-link text-nowrap" href="{{ route('services') }}">Lihat semua layanan <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>

            <div class="row g-4">
                @forelse ($services->take(5) as $service)
                    @php
                        $serviceIcon = match ($service->category) {
                            'wedding' => 'fa-heart',
                            'workshop' => 'fa-people-group',
                            'seminar' => 'fa-microphone-lines',
                            'sewa-crew' => 'fa-user-group',
                            'paket' => 'fa-layer-group',
                            default => 'fa-calendar-check',
                        };
                    @endphp
                    <div class="col-md-4">
                        <a class="card-clean p-4 d-flex flex-column text-decoration-none text-dark h-100" href="{{ route('services.show', $service) }}">
                            <div class="icon-box mb-3"><i class="fa-solid {{ $serviceIcon }}"></i></div>
                            <span class="eyebrow mb-1">{{ \Illuminate\Support\Str::headline($service->category) }}</span>
                            <h3 class="h4">{{ $service->name }}</h3>
                            <p class="text-secondary mb-3">{{ \Illuminate\Support\Str::limit($service->description, 120) }}</p>
                            <span class="text-link mt-auto">Pelajari layanan <i class="fa-solid fa-arrow-right ms-1"></i></span>
                        </a>
                    </div>
                @empty
                    <div class="col-12"><div class="card-clean p-4">Layanan event organizer segera hadir.</div></div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section" id="katalog">
        <div class="container">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
                <div class="section-head">
                    <span class="eyebrow">Perlengkapan pendukung</span>
                    <h2 class="display-6 mt-2 mb-2">Butuh alat untuk melengkapi acara?</h2>
                    <span class="visually-hidden">Pilih alat, cek jadwal, kami antar.</span>
                    <p class="text-secondary mb-0">Gunakan katalog perlengkapan kami sebagai bagian dari layanan event organizer atau sewa item sesuai kebutuhan Anda.</p>
                </div>
                <div class="search-box position-relative" style="min-width: 280px; max-width: 360px;">
                    <i class="fa-solid fa-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>
                    <input id="catalog-search" type="text" class="form-control rounded-pill ps-5 py-2" placeholder="Cari alat (mis. tenda, sound)..." aria-label="Cari alat">
                </div>
            </div>

            @if ($rentalItems->isNotEmpty())
                <div class="d-flex flex-wrap gap-2 mb-4" role="group" aria-label="Filter kategori alat">
                    <button type="button" class="filter-chip active" data-filter="all">
                        Semua <span class="badge rounded-pill bg-light text-dark ms-1">{{ $rentalItems->count() }}</span>
                    </button>
                    @foreach ($rentalCategories as $category)
                        <button type="button" class="filter-chip" data-filter="{{ $category }}">
                            {{ $categoryLabels[$category] ?? 'Lainnya' }} <span class="badge rounded-pill bg-light text-dark ms-1">{{ $rentalItems->where('category', $category)->count() }}</span>
                        </button>
                    @endforeach
                </div>

                <div class="d-flex flex-wrap align-items-center gap-3 small text-secondary mb-4">
                    <span class="d-inline-flex align-items-center gap-2">
                        <span class="availability availability-available"><i class="fa-solid fa-circle-check"></i>Tersedia</span>
                        siap dikirim
                    </span>
                    <span class="d-inline-flex align-items-center gap-2">
                        <span class="availability availability-limited"><i class="fa-solid fa-triangle-exclamation"></i>Terbatas</span>
                        cek stok terbatas
                    </span>
                    <span class="d-inline-flex align-items-center gap-2">
                        <span class="availability availability-unavailable"><i class="fa-solid fa-circle-xmark"></i>Tidak tersedia</span>
                        tanya jadwal berikutnya
                    </span>
                </div>

                <div class="row g-4" id="catalog-grid">
                    @foreach ($rentalItems as $item)
                        @php
                            $availability = $item->availabilityKey();
                            $inquiry = match ($availability) {
                                'unavailable' => 'Halo, saya ingin menanyakan jadwal berikutnya untuk menyewa '.$item->name.'.',
                                'limited' => 'Halo, saya ingin mengecek sisa stok terbatas untuk '.$item->name.' pada tanggal acara saya.',
                                default => 'Halo, saya ingin menyewa '.$item->name.' untuk acara saya. Mohon info ketersediaan dan harganya.',
                            };
                            $itemWaUrl = \App\Support\SiteContent::whatsappUrl($settings, $inquiry);
                        @endphp
                        <div class="col-md-6 col-lg-4" data-category="{{ $item->category }}" data-name="{{ strtolower($item->name.' '.$item->description.' '.($categoryLabels[$item->category] ?? '')) }}">
                            <div class="card-clean p-3 h-100 d-flex flex-column">
                                <div class="media-frame mb-3 position-relative">
                                    <a href="{{ route('rental-items.show', $item) }}" class="d-block w-100 h-100">
                                        @if ($item->photoUrl())
                                            <img src="{{ $item->photoUrl() }}" alt="Foto {{ $item->name }}" loading="lazy">
                                        @else
                                            <i class="{{ $item->categoryIcon() }}"></i>
                                        @endif
                                    </a>
                                    <span class="availability availability-{{ $availability }} position-absolute top-0 end-0 m-2">
                                        <i class="{{ $item->availabilityIcon() }}"></i>{{ $item->availabilityLabel() }}
                                    </span>
                                </div>
                                <span class="eyebrow mb-1">{{ $item->categoryLabel() }}</span>
                                <h3 class="h5">
                                    <a href="{{ route('rental-items.show', $item) }}" class="text-decoration-none text-dark">{{ $item->name }}</a>
                                </h3>
                                <div class="fw-semibold mb-2" style="color: var(--color-primary)">{{ $item->dailyPriceLabel() }}</div>
                                <p class="text-secondary small mb-3">{{ $item->description }}</p>

                                <div class="mt-auto d-flex gap-2">
                                    <a class="btn btn-ghost btn-sm flex-grow-1" target="_blank" rel="noopener" href="{{ $itemWaUrl }}">
                                        <i class="fa-brands fa-whatsapp me-1"></i> {{ $item->availabilityCta() }}
                                    </a>
                                    <a href="{{ route('rental-items.show', $item) }}" class="btn btn-outline-secondary btn-sm" title="Lihat detail & booking">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card-clean p-5 text-center">
                    <i class="fa-solid fa-box-open mb-3" style="font-size: 2rem; color: var(--color-secondary)"></i>
                    <h3 class="h5">Katalog sedang disiapkan</h3>
                    <p class="text-secondary mb-3">Sampaikan kebutuhan alat acara Anda, kami bantu cek ketersediaannya.</p>
                    <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">Hubungi via WhatsApp</a>
                </div>
            @endif
        </div>
    </section>

    <section class="section section-soft">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-4">
                    <span class="eyebrow">Kenapa sewa di kami</span>
                    <h2 class="display-6 mt-2">Fokus acara Anda, alat kami yang urus.</h2>
                    <p class="text-secondary">Tidak perlu membeli dan menyimpan perlengkapan sendiri. Sewa sesuai kebutuhan dan durasi acara.</p>
                    <a class="btn btn-main mt-2" href="{{ $waUrl }}" target="_blank" rel="noopener">Konsultasi kebutuhan alat</a>
                </div>
                <div class="col-lg-8">
                    <div class="row g-3">
                        @foreach ([
                            ['icon' => 'fa-screwdriver-wrench', 'title' => 'Stok terawat', 'text' => 'Perlengkapan diperiksa sebelum digunakan.'],
                            ['icon' => 'fa-truck-fast', 'title' => 'Antar & pasang', 'text' => 'Tim membantu pengiriman, pemasangan, dan penarikan.'],
                            ['icon' => 'fa-calendar-days', 'title' => 'Fleksibel', 'text' => 'Sewa harian atau sesuai durasi acara Anda.'],
                            ['icon' => 'fa-headset', 'title' => 'Pendampingan', 'text' => 'Butuh bantuan teknis? Tim kami siap di lokasi.'],
                        ] as $value)
                            <div class="col-sm-6">
                                <div class="card-clean p-4 h-100">
                                    <div class="icon-box mb-3"><i class="fa-solid {{ $value['icon'] }}"></i></div>
                                    <h3 class="h6">{{ $value['title'] }}</h3>
                                    <p class="text-secondary small mb-0">{{ $value['text'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head mb-4">
                <span class="eyebrow">Cara sewa</span>
                <h2 class="display-6 mt-2 mb-2">Empat langkah, alat siap di lokasi.</h2>
            </div>
            <div class="row g-3">
                @foreach ([
                    ['number' => '01', 'title' => 'Pilih alat', 'text' => 'Lihat katalog atau sampaikan kebutuhan acara Anda.'],
                    ['number' => '02', 'title' => 'Cek jadwal', 'text' => 'Kami konfirmasi ketersediaan item pada tanggal acara.'],
                    ['number' => '03', 'title' => 'Konfirmasi', 'text' => 'Sepakati item, durasi, lokasi, dan biaya sewa.'],
                    ['number' => '04', 'title' => 'Antar & pasang', 'text' => 'Tim mengirim, memasang, lalu menarik kembali setelah acara.'],
                ] as $step)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card-clean p-4 h-100">
                            <div class="step-number mb-3">{{ $step['number'] }}</div>
                            <h3 class="h6">{{ $step['title'] }}</h3>
                            <p class="text-secondary small mb-0">{{ $step['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if ($services->isNotEmpty())
        <section class="section section-soft">
            <div class="container">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
                    <div class="section-head">
                        <span class="eyebrow">Layanan pendukung</span>
                        <h2 class="display-6 mt-2 mb-2">Wedding, workshop, sewa crew, dan paket event.</h2>
                        <p class="text-secondary mb-0">Selain penyewaan alat, kami juga membantu penyelenggaraan acara.</p>
                    </div>
                    <a class="text-link text-nowrap" href="{{ route('services') }}">Lihat layanan <i class="fa-solid fa-arrow-right ms-1"></i></a>
                </div>
                <div class="row g-4">
                    @foreach ($services->take(5) as $service)
                        <div class="col-md-4">
                            <a class="card-clean p-4 d-flex flex-column text-decoration-none text-dark h-100" href="{{ route('services.show', $service) }}">
                                <div class="icon-box mb-3"><i class="fa-solid fa-calendar-check"></i></div>
                                <span class="eyebrow mb-1">{{ \Illuminate\Support\Str::headline($service->category) }}</span>
                                <h3 class="h5">{{ $service->name }}</h3>
                                <p class="text-secondary small mb-3">{{ \Illuminate\Support\Str::limit($service->description, 80) }}</p>
                                <span class="text-link mt-auto">Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i></span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
                <div class="section-head">
                    <span class="eyebrow">Rekam jejak</span>
                    <h2 class="display-6 mt-2 mb-2">Alat kami sudah mendukung berbagai acara</h2>
                    <p class="text-secondary mb-0">Sebagian kegiatan yang menggunakan layanan dan perlengkapan kami.</p>
                </div>
                <a class="text-link text-nowrap" href="{{ route('collaborations') }}">Lihat semua kerja sama <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>

            <div class="row g-4">
                @forelse ($collaborations as $collaboration)
                    <div class="col-md-6 col-lg-4">
                        <a class="card-clean p-3 d-flex flex-column text-decoration-none text-dark" href="{{ route('collaborations.show', $collaboration) }}">
                            <div class="media-frame mb-3 position-relative">
                                @if ($collaboration->coverUrl())
                                    <img src="{{ $collaboration->coverUrl() }}" alt="Foto kegiatan {{ $collaboration->event_name }}" loading="lazy">
                                @else
                                    <i class="fa-solid fa-camera-retro"></i>
                                @endif
                                <span class="badge rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1" style="background: rgba(8, 24, 15, .85);">
                                    {{ $collaboration->event_date->format('d M Y') }}
                                </span>
                            </div>
                            <span class="eyebrow mb-1">{{ $collaboration->partner_name }}</span>
                            <h3 class="h5">{{ $collaboration->event_name }}</h3>
                            <p class="text-secondary small mb-3">{{ \Illuminate\Support\Str::limit($collaboration->description, 95) }}</p>
                            <span class="text-link mt-auto">Lihat galeri <i class="fa-solid fa-arrow-right ms-1"></i></span>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card-clean p-5 text-center">
                            <i class="fa-solid fa-handshake-angle mb-3" style="font-size: 2rem; color: var(--color-secondary)"></i>
                            <h3 class="h5">Portofolio sedang kami siapkan</h3>
                            <p class="text-secondary mb-0">Hubungi kami untuk mengetahui kegiatan yang pernah kami tangani.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section section-soft">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
                <div class="section-head">
                    <span class="eyebrow">Testimoni</span>
                    <h2 class="display-6 mt-2 mb-2">Kata mereka yang sudah menyewa</h2>
                    <p class="text-secondary mb-0">Pengalaman mitra menjadi bagian penting dari cara kami bekerja.</p>
                </div>
                <a class="text-link text-nowrap" href="{{ route('testimonials') }}">Lihat semua testimoni <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>

            <div class="row g-4">
                @forelse ($testimonials as $testimonial)
                    <div class="col-md-4">
                        <div class="card-clean p-4 h-100 d-flex flex-column">
                            <div class="mb-3" style="color: var(--color-secondary);">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-{{ $i <= ($testimonial->rating ?? 5) ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            </div>
                            <p class="flex-grow-1">“{{ $testimonial->comment }}”</p>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                @if ($testimonial->photoUrl())
                                    <img src="{{ $testimonial->photoUrl() }}" alt="Foto {{ $testimonial->name }}" width="42" height="42" class="rounded-circle" style="object-fit: cover;" loading="lazy">
                                @else
                                    <div class="rounded-circle" style="width: 42px; height: 42px; background: var(--color-primary); color: #000; display: grid; place-items: center; font-weight: 700;">
                                        {{ $testimonial->initials() }}
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-semibold">{{ $testimonial->name }}</div>
                                    <div class="small text-secondary">{{ $testimonial->organization }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card-clean p-5 text-center">
                            <i class="fa-solid fa-quote-left mb-3" style="font-size: 2rem; color: var(--color-secondary)"></i>
                            <h3 class="h5">Jadilah mitra berikutnya</h3>
                            <p class="text-secondary mb-0">Kami siap membantu kebutuhan alat acara Anda.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="cta-band p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="eyebrow">Cek ketersediaan</span>
                        <h2 class="display-6 text-white mt-2 mb-2">Butuh alat untuk acara minggu ini?</h2>
                        <p class="mb-0 text-white-50">Kirim daftar kebutuhan dan tanggal acara. Kami bantu cek stok serta jadwal pengiriman.</p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column flex-sm-row flex-lg-column gap-2 justify-content-lg-end">
                        <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp me-1"></i> Chat via WhatsApp
                        </a>
                        <a class="btn btn-ghost" href="{{ route('custom') }}"><i class="fa-solid fa-list-check me-1"></i> Rancang kebutuhan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .hero-copy {
                max-width: 900px;
            }

            /* Hero dengan latar gambar bergulir. */
            .hero-with-slider {
                display: flex;
                align-items: center;
                min-height: clamp(36rem, 86vh, 50rem);
                padding: 9rem 0 6rem;
            }

            .hero-with-slider::after {
                display: none;
            }

            .hero-with-slider .container {
                position: relative;
                z-index: 2;
            }

            .hero-with-slider .hero-copy {
                max-width: 780px;
                color: #fff8e8;
                text-shadow: 0 2px 18px rgba(0, 0, 0, .5);
            }

            .hero-with-slider .hero-copy h1 {
                color: #fff8e8;
                text-shadow: 0 3px 22px rgba(0, 0, 0, .62);
            }

            .hero-with-slider .hero-copy .lead,
            .hero-with-slider .hero-copy .text-secondary,
            .hero-with-slider .hero-copy .small {
                color: rgba(255, 250, 237, .92) !important;
            }

            .hero-with-slider .hero-copy .stat-value {
                color: #ffc343;
                text-shadow: 0 2px 12px rgba(0, 0, 0, .55);
            }

            .hero-with-slider .hero-copy .btn-ghost {
                color: #fff8e8;
                border-color: rgba(255, 248, 232, .72);
                text-shadow: 0 1px 8px rgba(0, 0, 0, .35);
            }

            .hero-with-slider .hero-slider {
                position: absolute;
                inset: 0;
                z-index: 0;
                overflow: hidden;
            }

            .hero-with-slider .hero-slider .carousel-inner,
            .hero-with-slider .hero-slider .carousel-item,
            .hero-with-slider .hero-slider .hero-slide {
                height: 100%;
                min-height: 0;
            }

            .hero-with-slider .hero-slider .hero-slide {
                background-position: center;
                background-size: cover;
                transform: translate3d(0, var(--parallax-y, 0px), 0) scale(1.08);
                transform-origin: center;
                will-change: transform;
            }

            .hero-with-slider .hero-slider .hero-slide::after {
                display: none;
            }

            .hero-with-slider .hero-slider::before {
                content: '';
                position: absolute;
                inset: 0;
                z-index: 1;
                pointer-events: none;
                background:
                    linear-gradient(90deg, rgba(8, 24, 15, .99) 0%, rgba(8, 24, 15, .92) 42%, rgba(8, 24, 15, .58) 100%),
                    linear-gradient(180deg, rgba(8, 24, 15, .55) 0%, rgba(8, 24, 15, .1) 45%, rgba(8, 24, 15, .85) 100%);
            }

            .hero-with-slider .hero-slider .carousel-indicators {
                bottom: 1.25rem;
                z-index: 3;
                margin-bottom: 0;
            }

            .hero-with-slider .hero-slider .carousel-indicators button {
                opacity: .4;
            }

            .hero-with-slider .hero-slider .carousel-indicators button.active {
                opacity: 1;
            }

            @media (prefers-reduced-motion: reduce) {
                .hero-with-slider .hero-slider .hero-slide {
                    transform: none;
                    will-change: auto;
                }
            }

            /* Skala tipografi khusus landing page agar lebih ringkas. */
            .hero .display-3 {
                font-size: clamp(34px, 4.6vw, 58px);
                line-height: 1.06;
                letter-spacing: -.035em;
            }

            .hero .lead {
                font-size: 1.0625rem;
                line-height: 1.7;
            }

            .section .display-6 {
                font-size: clamp(28px, 3.4vw, 44px);
                line-height: 1.08;
                letter-spacing: -.03em;
            }

            .stat-value {
                font-size: 1.55rem;
            }

            @media (max-width: 639.98px) {
                .hero-with-slider {
                    min-height: 33rem;
                    padding: 7.5rem 0 3.5rem;
                }

                .hero-with-slider .hero-slider::before {
                    background: linear-gradient(180deg, rgba(8, 24, 15, .92) 0%, rgba(8, 24, 15, .78) 55%, rgba(8, 24, 15, .92) 100%);
                }

                .hero .display-3 {
                    font-size: clamp(28px, 8.4vw, 36px);
                    line-height: 1.1;
                }

                .section .display-6 {
                    font-size: clamp(23px, 6.4vw, 30px);
                    line-height: 1.15;
                }

                .hero .lead {
                    font-size: 1rem;
                }

                .stat-value {
                    font-size: 1.35rem;
                }
            }

            .rental-thumb {
                width: 3.2rem;
                height: 3.2rem;
                border-radius: 14px;
                background: var(--mint);
                color: var(--color-primary);
                display: grid;
                place-items: center;
                overflow: hidden;
                flex-shrink: 0;
            }

            .rental-thumb img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .filter-chip {
                border: 1px solid var(--line);
                background: var(--color-bg-secondary);
                color: var(--color-text);
                border-radius: 100px;
                padding: .5rem 1rem;
                font-size: .875rem;
                font-weight: 600;
            }

            .filter-chip:hover,
            .filter-chip.active {
                background: var(--color-primary);
                border-color: var(--color-primary);
                color: #0d2620;
            }

            .step-number {
                font-family: 'Funnel Display', sans-serif;
                font-weight: 800;
                color: var(--color-primary);
                font-size: 1.75rem;
                line-height: 1;
                letter-spacing: -.03em;
            }

            .cta-band {
                background: var(--mint);
                border: 1px solid var(--line);
                border-radius: 18px;
                position: relative;
                overflow: hidden;
            }

            .cta-band::after {
                content: '';
                position: absolute;
                width: 18rem;
                height: 18rem;
                border-radius: 50%;
                right: -6rem;
                top: -6rem;
                background: rgba(242, 178, 51, .16);
            }

            .cta-band .btn {
                border-radius: 100px;
                font-weight: 600;
                padding: .7rem 1.2rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            (function () {
                const searchInput = document.getElementById('catalog-search');
                let activeCategory = 'all';

                function filterItems() {
                    const query = (searchInput ? searchInput.value : '').toLowerCase().trim();

                    document.querySelectorAll('[data-category]').forEach(function (card) {
                        const categoryMatch = (activeCategory === 'all') || (card.dataset.category === activeCategory);
                        const cardText = (card.dataset.name || '').toLowerCase();
                        const searchMatch = query === '' || cardText.includes(query);

                        card.classList.toggle('d-none', !(categoryMatch && searchMatch));
                    });
                }

                document.querySelectorAll('.filter-chip').forEach(function (button) {
                    button.addEventListener('click', function () {
                        activeCategory = button.dataset.filter;

                        document.querySelectorAll('.filter-chip').forEach(function (chip) {
                            chip.classList.toggle('active', chip === button);
                        });

                        filterItems();
                    });
                });

                if (searchInput) {
                    searchInput.addEventListener('input', filterItems);
                }
            })();
        </script>
        <script>
            (function () {
                const hero = document.querySelector('.hero-with-slider');
                const slides = document.querySelectorAll('.hero-with-slider .hero-slide');

                if (!hero || !slides.length || !('requestAnimationFrame' in window)) {
                    return;
                }

                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    return;
                }

                let ticking = false;

                function updateParallax() {
                    const rect = hero.getBoundingClientRect();
                    const offset = Math.max(-42, Math.min(42, -rect.top * .1));

                    slides.forEach(function (slide) {
                        slide.style.setProperty('--parallax-y', offset + 'px');
                    });

                    ticking = false;
                }

                function requestParallaxUpdate() {
                    if (!ticking) {
                        window.requestAnimationFrame(updateParallax);
                        ticking = true;
                    }
                }

                window.addEventListener('scroll', requestParallaxUpdate, { passive: true });
                window.addEventListener('resize', requestParallaxUpdate, { passive: true });
                requestParallaxUpdate();
            })();
        </script>
    @endpush
</x-layouts.public>
