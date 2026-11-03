@php
    $siteName = $settings['site_name'] ?? 'Lini Jaya Event';
    $waUrl = \App\Support\SiteContent::whatsappUrl($settings, 'Halo, saya ingin berkonsultasi mengenai rencana acara dengan tim '.$siteName.'.');
    $partnerCount = $collaborations->pluck('partner_name')->filter()->unique()->count();
    $photoCount = $collaborations->sum(fn ($collaboration) => $collaboration->photos->filter(fn ($photo) => $photo->photoUrl())->count());
    $gallery = $collaborations
        ->flatMap(fn ($collaboration) => $collaboration->photos->map(fn ($photo) => ['photo' => $photo, 'collaboration' => $collaboration]))
        ->filter(fn ($entry) => $entry['photo']->photoUrl())
        ->take(8);
@endphp

<x-layouts.public :title="'Kerja Sama — '.$siteName" :settings="$settings">
    <section class="hero">
        <div class="container">
            <div class="eyebrow">Kerja sama · Portofolio</div>
            <h1 class="display-4 mt-2">Rekam jejak kerja sama dalam penyelenggaraan acara.</h1>
            <p class="lead text-secondary mt-3 col-lg-9 ps-0">
                Dokumentasi kegiatan yang telah kami dukung bersama instansi, perusahaan, dan komunitas, mulai dari perencanaan hingga pelaksanaan.
            </p>

            @if ($collaborations->isNotEmpty())
                <div class="d-flex flex-wrap gap-4 mt-4">
                    <div>
                        <div class="stat-value">{{ $collaborations->count() }}</div>
                        <div class="small text-secondary">Kegiatan terdokumentasi</div>
                    </div>
                    <div>
                        <div class="stat-value">{{ $partnerCount }}</div>
                        <div class="small text-secondary">Mitra kerja sama</div>
                    </div>
                    <div>
                        <div class="stat-value">{{ $photoCount }}</div>
                        <div class="small text-secondary">Foto dokumentasi</div>
                    </div>
                </div>
            @endif

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">
                    <i class="fa-brands fa-whatsapp me-1"></i> Konsultasi via WhatsApp
                </a>
                <a class="btn btn-ghost" href="{{ route('services') }}">
                    <i class="fa-solid fa-list-check me-1"></i> Lihat Layanan Kami
                </a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head mb-4">
                <span class="eyebrow">Dokumentasi kegiatan</span>
                <h2 class="display-6 mt-2 mb-2">Kegiatan yang telah kami dukung.</h2>
                <p class="text-secondary mb-0">Setiap kegiatan menjadi bagian dari pengalaman kami dalam menangani kebutuhan acara dengan skala dan karakter yang beragam.</p>
            </div>

            <div class="row g-4">
                @forelse ($collaborations as $collaboration)
                    <div class="col-md-6 col-lg-4">
                        <a class="card-clean p-3 d-flex flex-column text-decoration-none text-dark h-100" href="{{ route('collaborations.show', $collaboration) }}">
                            <div class="media-frame mb-3 position-relative">
                                @if ($collaboration->coverUrl())
                                    <img src="{{ $collaboration->coverUrl() }}" alt="Dokumentasi {{ $collaboration->event_name }}" loading="lazy">
                                @else
                                    <i class="fa-solid fa-camera-retro"></i>
                                @endif
                                <span class="badge rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1" style="background: rgba(8, 24, 15, .85);">
                                    {{ $collaboration->event_date->locale('id')->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <span class="eyebrow mb-1">{{ $collaboration->partner_name }}</span>
                            <h3 class="h5">{{ $collaboration->event_name }}</h3>
                            <p class="text-secondary small mb-3">{{ \Illuminate\Support\Str::limit($collaboration->description, 95) }}</p>
                            <span class="text-link mt-auto">Lihat dokumentasi <i class="fa-solid fa-arrow-right ms-1"></i></span>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card-clean p-5 text-center">
                            <i class="fa-solid fa-handshake-angle mb-3" style="font-size: 2rem; color: var(--color-secondary)"></i>
                            <h3 class="h5">Portofolio sedang kami siapkan</h3>
                            <p class="text-secondary mb-3">Dokumentasi kerja sama akan ditampilkan pada bagian ini setelah kegiatan selesai dievaluasi.</p>
                            <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">Hubungi via WhatsApp</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @if ($gallery->isNotEmpty())
        <section class="section section-soft">
            <div class="container">
                <div class="section-head mb-4">
                    <span class="eyebrow">Galeri</span>
                    <h2 class="display-6 mt-2 mb-2">Potret pelaksanaan acara.</h2>
                    <p class="text-secondary mb-0">Sebagian dokumentasi visual dari kegiatan yang telah kami tangani bersama mitra.</p>
                </div>

                <div class="row g-3">
                    @foreach ($gallery as $entry)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a class="card-clean p-2 d-block text-decoration-none h-100" href="{{ route('collaborations.show', $entry['collaboration']) }}">
                                <div class="media-frame mb-2">
                                    <img src="{{ $entry['photo']->photoUrl() }}" alt="{{ $entry['photo']->caption ?: 'Dokumentasi '.$entry['collaboration']->event_name }}" loading="lazy">
                                </div>
                                <div class="small text-secondary px-1 pb-1">{{ $entry['collaboration']->event_name }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section">
        <div class="container">
            <div class="cta-band p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="eyebrow">Kerja sama berikutnya</span>
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
</x-layouts.public>
