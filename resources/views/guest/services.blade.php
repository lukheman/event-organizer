@php
    $siteName = $settings['site_name'] ?? 'Lini Jaya Event';
    $waUrl = \App\Support\SiteContent::whatsappUrl($settings, 'Halo, saya ingin berkonsultasi mengenai layanan acara dengan tim '.$siteName.'.');
@endphp

<x-layouts.public :title="'Jasa Event Organizer — '.$siteName" :settings="$settings">
    <section class="hero">
        <div class="container">
            <div class="eyebrow">Layanan · Event organizer</div>
            <h1 class="display-4 mt-2">Layanan event organizer untuk acara yang terencana.</h1>
            <p class="lead text-secondary mt-3 col-lg-9 ps-0">
                Kami mendukung perencanaan konsep, pengelolaan produksi, pelaksanaan operasional, dan penyediaan perlengkapan agar setiap acara berjalan sesuai tujuan.
            </p>
            <div class="d-flex flex-wrap gap-2 mt-4">
                <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">
                    <i class="fa-brands fa-whatsapp me-1"></i> Konsultasi via WhatsApp
                </a>
                <a class="btn btn-ghost" href="{{ route('custom') }}">
                    <i class="fa-solid fa-list-check me-1"></i> Rancang Kebutuhan
                </a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head mb-4">
                <span class="eyebrow">Pilihan layanan</span>
                <h2 class="display-6 mt-2 mb-2">Satu partner untuk berbagai kebutuhan acara.</h2>
                <p class="text-secondary mb-0">Layanan dapat digabungkan atau disesuaikan dengan skala acara, kebutuhan teknis, dan anggaran Anda.</p>
            </div>

            <div class="row g-4">
                @forelse ($services as $service)
                    @php
                        $servicePhotos = $documentation->get($service->category, collect());
                        $cover = $servicePhotos->first()?->coverUrl();
                    @endphp
                    <div class="col-md-6">
                        <a href="{{ route('services.show', $service) }}" class="card-clean p-3 d-flex flex-column text-decoration-none text-dark h-100">
                            <div class="media-frame mb-3 position-relative">
                                @if ($cover)
                                    <img src="{{ $cover }}" alt="Dokumentasi layanan {{ $service->name }}" loading="lazy">
                                    <span class="badge rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1" style="background: rgba(8, 24, 15, .85);">
                                        Dokumentasi layanan
                                    </span>
                                @else
                                    <div class="text-center">
                                        <div class="icon-box mx-auto mb-2">
                                            <i class="fa-solid {{ match ($service->category) {
                                                'penyewaan' => 'fa-box-open',
                                                'wedding' => 'fa-heart',
                                                'workshop' => 'fa-people-group',
                                                'seminar' => 'fa-microphone-lines',
                                                'sewa-crew' => 'fa-user-group',
                                                'paket' => 'fa-layer-group',
                                                default => 'fa-calendar-check',
                                            } }}"></i>
                                        </div>
                                        <span class="eyebrow">{{ \Illuminate\Support\Str::headline($service->category) }}</span>
                                    </div>
                                @endif
                            </div>

                            <span class="eyebrow mb-1">{{ \Illuminate\Support\Str::headline($service->category) }}</span>
                            <h2 class="h4 mt-1">{{ $service->name }}</h2>
                            <p class="text-secondary">{{ $service->description }}</p>

                            @if (! empty($service->features))
                                <ul class="list-unstyled small text-secondary mb-3">
                                    @foreach ($service->features as $feature)
                                        <li class="mb-1"><i class="fa-solid fa-check me-2" style="color: var(--color-primary)"></i>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <span class="text-link mt-auto">Pelajari layanan <i class="fa-solid fa-arrow-right ms-1"></i></span>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card-clean p-5 text-center">
                            <i class="fa-solid fa-calendar-check mb-3" style="font-size: 2rem; color: var(--color-secondary)"></i>
                            <h3 class="h5">Layanan sedang disiapkan</h3>
                            <p class="text-secondary mb-3">Sampaikan kebutuhan acara Anda, kami bantu susun rekomendasinya.</p>
                            <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">Hubungi via WhatsApp</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section section-soft">
        <div class="container">
            <div class="section-head mb-4">
                <span class="eyebrow">Cara kerja</span>
                <h2 class="display-6 mt-2 mb-2">Tiga tahap pendampingan acara.</h2>
                <p class="text-secondary mb-0">Setiap tahap dikoordinasikan bersama Anda agar keputusan dapat diambil secara tepat dan terukur.</p>
            </div>

            <div class="row g-3">
                @foreach ([
                    ['number' => '01', 'title' => 'Konsultasi kebutuhan', 'text' => 'Kami memetakan tujuan acara, jumlah tamu, lokasi, dan kebutuhan teknis.'],
                    ['number' => '02', 'title' => 'Penyusunan rencana', 'text' => 'Rekomendasi layanan, rundown, dan anggaran disusun sesuai prioritas acara.'],
                    ['number' => '03', 'title' => 'Pelaksanaan & evaluasi', 'text' => 'Tim menjalankan rencana di lokasi, lalu mengevaluasi hasilnya bersama Anda.'],
                ] as $step)
                    <div class="col-md-4">
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

    <section class="section">
        <div class="container">
            <div class="cta-band p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="eyebrow">Konsultasi layanan</span>
                        <h2 class="display-6 text-white mt-2 mb-2">Tentukan layanan yang sesuai kebutuhan acara.</h2>
                        <p class="mb-0 text-white-50">Sampaikan tujuan dan tanggal acara Anda. Tim {{ $siteName }} akan membantu menyusun kombinasi layanan yang tepat.</p>
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
            .step-number {
                font-family: 'Funnel Display', sans-serif;
                font-weight: 800;
                color: var(--color-primary);
                font-size: 1.75rem;
                line-height: 1;
                letter-spacing: -.03em;
            }
        </style>
    @endpush
</x-layouts.public>
