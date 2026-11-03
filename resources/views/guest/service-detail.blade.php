@php
    $siteName = $settings['site_name'] ?? 'Lini Jaya Event';
    $waUrl = \App\Support\SiteContent::whatsappUrl($settings, 'Halo, saya ingin bertanya tentang '.$service->name.' untuk acara saya.');
    $features = $service->features ?? [];
    $documentation = $relatedCollaborations
        ->filter(fn ($collaboration) => $collaboration->coverUrl())
        ->take(3);
@endphp

<x-layouts.public :title="$service->name.' — '.$siteName" :settings="$settings">
    <section class="hero">
        <div class="container">
            <div class="eyebrow">Layanan · {{ \Illuminate\Support\Str::headline($service->category) }}</div>
            <h1 class="display-4 mt-2">{{ $service->name }}</h1>
            <p class="lead text-secondary mt-3 col-lg-9 ps-0">{{ $service->description }}</p>

            <div class="d-flex flex-wrap gap-3 mt-4 small text-secondary">
                @if (count($features))
                    <span class="d-inline-flex align-items-center gap-2">
                        <i class="fa-solid fa-list-check" style="color: var(--color-primary)"></i>
                        {{ count($features) }} cakupan layanan
                    </span>
                @endif
                @if ($documentation->isNotEmpty())
                    <span class="d-inline-flex align-items-center gap-2">
                        <i class="fa-solid fa-images" style="color: var(--color-primary)"></i>
                        {{ $documentation->count() }} kegiatan terdokumentasi
                    </span>
                @endif
                @if ($service->rentalItems->isNotEmpty())
                    <span class="d-inline-flex align-items-center gap-2">
                        <i class="fa-solid fa-box-open" style="color: var(--color-primary)"></i>
                        {{ $service->rentalItems->count() }} item pendukung
                    </span>
                @endif
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">
                    <i class="fa-brands fa-whatsapp me-1"></i> Konsultasi Layanan Ini
                </a>
                <a class="btn btn-ghost" href="{{ route('services') }}">
                    <i class="fa-solid fa-arrow-left me-1"></i> Semua Layanan
                </a>
            </div>
        </div>
    </section>

    @if (count($features) && $service->category !== 'paket')
        <section class="section">
            <div class="container">
                <div class="section-head mb-4">
                    <span class="eyebrow">Cakupan layanan</span>
                    <h2 class="display-6 mt-2 mb-2">Yang Anda dapatkan.</h2>
                    <p class="text-secondary mb-0">Ruang lingkup berikut dapat disesuaikan dengan skala acara dan kebutuhan Anda.</p>
                </div>

                @php
                    $featureColumn = count($features) % 3 === 0 ? 'col-md-4' : 'col-md-6';
                @endphp

                <div class="row g-3">
                    @foreach ($features as $feature)
                        <div class="{{ $featureColumn }}">
                            <div class="card-clean p-4 h-100 d-flex gap-3">
                                <i class="fa-solid fa-circle-check mt-1" style="color: var(--color-primary)"></i>
                                <span>{{ $feature }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($service->category === 'paket')
        <section class="section">
            <div class="container">
                <div class="section-head mb-4">
                    <span class="eyebrow">Pilihan paket</span>
                    <h2 class="display-6 mt-2 mb-2">Pilih paket yang sesuai acara Anda.</h2>
                    <p class="text-secondary mb-0">Isi paket dan harga dapat disesuaikan bersama tim sesuai kebutuhan serta anggaran acara.</p>
                </div>

                <div class="row g-4">
                    @foreach (config('packages') as $package)
                        @php
                            $packageMessage = 'Halo, saya tertarik dengan '.$package['name'].' untuk acara saya. Mohon kirimkan detail isi paket dan penawaran harganya.';
                        @endphp
                        <div class="col-md-4">
                            <div class="card-clean p-4 h-100 d-flex flex-column">
                                <div class="icon-box mb-3"><i class="fa-solid fa-layer-group"></i></div>
                                <h3 class="h4">{{ $package['name'] }}</h3>
                                <p class="text-secondary">{{ $package['description'] }}</p>
                                <ul class="list-unstyled small text-secondary mb-4">
                                    @foreach ($package['features'] as $feature)
                                        <li class="mb-2"><i class="fa-solid fa-check me-2" style="color: var(--color-secondary)"></i>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                                <a class="btn btn-main mt-auto" target="_blank" rel="noopener" href="{{ \App\Support\SiteContent::whatsappUrl($settings, $packageMessage) }}">
                                    <i class="fa-brands fa-whatsapp me-1"></i> Pilih paket ini
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($documentation->isNotEmpty())
        <section class="section {{ $service->category === 'paket' ? 'section-soft' : '' }}">
            <div class="container">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
                    <div class="section-head">
                        <span class="eyebrow">Dokumentasi</span>
                        <h2 class="display-6 mt-2 mb-2">Potret layanan {{ $service->name }}.</h2>
                        <p class="text-secondary mb-0">Sebagian dokumentasi kegiatan yang menggunakan layanan dengan kategori serupa.</p>
                    </div>
                    <a class="text-link text-nowrap" href="{{ route('collaborations') }}">Lihat semua portofolio <i class="fa-solid fa-arrow-right ms-1"></i></a>
                </div>

                <div class="row g-3 justify-content-center">
                    @foreach ($documentation as $collaboration)
                        <div class="col-sm-6 col-lg-4">
                            <a class="card-clean p-2 d-flex flex-column text-decoration-none text-dark h-100" href="{{ route('collaborations.show', $collaboration) }}">
                                <div class="media-frame mb-2">
                                    <img src="{{ $collaboration->coverUrl() }}" alt="Dokumentasi {{ $collaboration->event_name }}" loading="lazy">
                                </div>
                                <div class="px-1 pb-1">
                                    <span class="eyebrow">{{ $collaboration->partner_name }}</span>
                                    <h3 class="h6 mt-1 mb-1">{{ $collaboration->event_name }}</h3>
                                    <span class="small text-secondary">{{ $collaboration->event_date->locale('id')->translatedFormat('d F Y') }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($service->rentalItems->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
                    <div class="section-head">
                        <span class="eyebrow">Perlengkapan pendukung</span>
                        <h2 class="display-6 mt-2 mb-2">Item yang dapat disewa.</h2>
                        <p class="text-secondary mb-0">Ketersediaan dan harga menyesuaikan item serta durasi penggunaan.</p>
                    </div>
                    <a class="text-link text-nowrap" href="{{ route('home') }}#katalog">Lihat katalog lengkap <i class="fa-solid fa-arrow-right ms-1"></i></a>
                </div>

                <div class="row g-4">
                    @foreach ($service->rentalItems as $item)
                        @php
                            $availability = $item->availabilityKey();
                            $inquiry = 'Halo, saya ingin menyewa '.$item->name.' untuk acara saya. Mohon info ketersediaan dan harganya.';
                        @endphp
                        <div class="col-md-6 col-lg-4">
                            <div class="card-clean p-3 h-100 d-flex flex-column">
                                <div class="media-frame mb-3 position-relative">
                                    @if ($item->photoUrl())
                                        <img src="{{ $item->photoUrl() }}" alt="Foto {{ $item->name }}" loading="lazy">
                                    @else
                                        <i class="{{ $item->categoryIcon() }}"></i>
                                    @endif
                                    <span class="availability availability-{{ $availability }} position-absolute top-0 end-0 m-2">
                                        <i class="{{ $item->availabilityIcon() }}"></i>{{ $item->availabilityLabel() }}
                                    </span>
                                </div>
                                <span class="eyebrow mb-1">{{ $item->categoryLabel() }}</span>
                                <h3 class="h5">{{ $item->name }}</h3>
                                <div class="fw-semibold mb-2" style="color: var(--color-primary)">{{ $item->dailyPriceLabel() }}</div>
                                <p class="text-secondary small mb-3">{{ $item->description }}</p>
                                <a class="btn btn-ghost btn-sm mt-auto align-self-start" target="_blank" rel="noopener" href="{{ \App\Support\SiteContent::whatsappUrl($settings, $inquiry) }}">
                                    <i class="fa-brands fa-whatsapp me-1"></i> Tanya Ketersediaan
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section section-soft">
        <div class="container">
            <div class="cta-band p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="eyebrow">Konsultasi layanan</span>
                        <h2 class="display-6 text-white mt-2 mb-2">Diskusikan kebutuhan {{ $service->name }} Anda.</h2>
                        <p class="mb-0 text-white-50">Sampaikan tujuan, tanggal, dan kebutuhan acara. Tim {{ $siteName }} akan membantu menyusun rencana yang sesuai.</p>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-lg-end">
                        <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp me-1"></i> Mulai Diskusi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
