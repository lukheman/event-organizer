@php
    $siteName = $settings['site_name'] ?? 'Lini Jaya Event';
    $waUrl = \App\Support\SiteContent::whatsappUrl($settings, 'Halo, saya ingin berkonsultasi mengenai rencana acara dengan tim '.$siteName.'.');
    $photos = $collaboration->photos->filter(fn ($photo) => $photo->photoUrl());
@endphp

<x-layouts.public :title="$collaboration->event_name.' — '.$siteName" :settings="$settings">
    <section class="hero">
        <div class="container">
            <div class="eyebrow">{{ $collaboration->partner_name }} · {{ $collaboration->event_date->locale('id')->translatedFormat('d F Y') }}</div>
            <h1 class="display-4 mt-2">{{ $collaboration->event_name }}</h1>
            <p class="lead text-secondary mt-3 col-lg-9 ps-0">{{ $collaboration->description }}</p>

            <div class="d-flex flex-wrap gap-3 mt-4 small text-secondary">
                @if ($collaboration->service_category)
                    <span class="d-inline-flex align-items-center gap-2">
                        <i class="fa-solid fa-layer-group" style="color: var(--color-primary)"></i>
                        {{ \Illuminate\Support\Str::headline($collaboration->service_category) }}
                    </span>
                @endif
                <span class="d-inline-flex align-items-center gap-2">
                    <i class="fa-solid fa-images" style="color: var(--color-primary)"></i>
                    {{ $photos->count() }} foto dokumentasi
                </span>
                <span class="d-inline-flex align-items-center gap-2">
                    <i class="fa-solid fa-handshake-angle" style="color: var(--color-primary)"></i>
                    {{ $collaboration->partner_name }}
                </span>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">
                    <i class="fa-brands fa-whatsapp me-1"></i> Konsultasi via WhatsApp
                </a>
                <a class="btn btn-ghost" href="{{ route('collaborations') }}">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Portofolio
                </a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="card-clean p-4 p-md-5">
                <div class="row g-4 g-lg-5">
                    <div class="col-lg-7">
                        <span class="eyebrow">Tentang kegiatan</span>
                        <h2 class="h3 mt-2 mb-3">Ringkasan pelaksanaan acara.</h2>
                        <p class="text-secondary mb-0">{{ $collaboration->description }}</p>
                    </div>

                    <div class="col-lg-5">
                        <div class="detail-info">
                            <span class="eyebrow">Informasi kegiatan</span>
                            <h3 class="h5 mt-2 mb-3">{{ $collaboration->event_name }}</h3>
                            <div class="d-flex flex-column gap-3 small text-secondary">
                                <span class="d-flex gap-2">
                                    <i class="fa-solid fa-handshake-angle mt-1" style="color: var(--color-primary)"></i>
                                    <span>{{ $collaboration->partner_name }}</span>
                                </span>
                                <span class="d-flex gap-2">
                                    <i class="fa-regular fa-calendar mt-1" style="color: var(--color-primary)"></i>
                                    <span>{{ $collaboration->event_date->locale('id')->translatedFormat('d F Y') }}</span>
                                </span>
                                @if ($collaboration->service_category)
                                    <span class="d-flex gap-2">
                                        <i class="fa-solid fa-layer-group mt-1" style="color: var(--color-primary)"></i>
                                        <span>{{ \Illuminate\Support\Str::headline($collaboration->service_category) }}</span>
                                    </span>
                                @endif
                                <span class="d-flex gap-2">
                                    <i class="fa-solid fa-images mt-1" style="color: var(--color-primary)"></i>
                                    <span>{{ $photos->count() }} foto dokumentasi</span>
                                </span>
                            </div>

                            <a class="btn btn-main w-100 mt-4" href="{{ $waUrl }}" target="_blank" rel="noopener">
                                <i class="fa-brands fa-whatsapp me-1"></i> Diskusikan Acara Serupa
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if ($photos->isNotEmpty())
                <div class="section-head mt-5 mb-3">
                    <span class="eyebrow">Galeri dokumentasi</span>
                    <h2 class="h3 mt-2 mb-0">Potret kegiatan bersama {{ $collaboration->partner_name }}.</h2>
                </div>

                @php
                    $galleryColumn = match (true) {
                        $photos->count() === 1 => 'col-12',
                        $photos->count() === 2 => 'col-md-6',
                        default => 'col-sm-6 col-lg-4',
                    };
                @endphp

                <div class="row g-3">
                    @foreach ($photos as $photo)
                        <div class="{{ $galleryColumn }}">
                            <div class="card-clean p-2 h-100">
                                <div class="ratio ratio-4x3 rounded-3 overflow-hidden">
                                    <img src="{{ $photo->photoUrl() }}" alt="{{ $photo->caption ?: 'Dokumentasi '.$collaboration->event_name }}" class="w-100 h-100" style="object-fit: cover;" loading="lazy">
                                </div>
                                @if ($photo->caption)
                                    <p class="small text-secondary mt-2 mb-1 px-1">{{ $photo->caption }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card-clean p-5 text-center mt-4">
                    <i class="fa-solid fa-camera-retro mb-3" style="font-size: 2rem; color: var(--color-secondary)"></i>
                    <h3 class="h5">Dokumentasi sedang disiapkan</h3>
                    <p class="text-secondary mb-0">Foto kegiatan akan ditampilkan pada bagian ini setelah proses penyuntingan selesai.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="section section-soft">
        <div class="container">
            <div class="cta-band p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="eyebrow">Konsultasi acara</span>
                        <h2 class="display-6 text-white mt-2 mb-2">Rencanakan acara Anda bersama kami.</h2>
                        <p class="mb-0 text-white-50">Sampaikan tujuan, tanggal, dan kebutuhan acara Anda. Tim {{ $siteName }} akan membantu menyusun rencana yang sesuai.</p>
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

    @push('styles')
        <style>
            @media (min-width: 992px) {
                .detail-info {
                    padding-left: 2.5rem;
                    border-left: 1px solid var(--line);
                }
            }
        </style>
    @endpush
</x-layouts.public>
