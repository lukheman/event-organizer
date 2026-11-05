@php
    $siteName = $settings['site_name'] ?? 'Lini Jaya Event';
    $waUrl = \App\Support\SiteContent::whatsappUrl($settings, 'Halo, saya ingin berkonsultasi mengenai rencana acara dengan tim '.$siteName.'.');
    $mapAddress = $settings['address'] ?? 'Makassar';
    $mapUrl = $settings['map_embed'] ?? 'https://www.google.com/maps?q='.urlencode($mapAddress).'&output=embed';
@endphp

<x-layouts.public :title="'Kontak — '.$siteName" :settings="$settings">
    <section class="hero">
        <div class="container">
            <div class="eyebrow">Kontak · Konsultasi acara</div>
            <h1 class="display-4 mt-2">Mari bicarakan acara Anda.</h1>
            <p class="lead text-secondary mt-3 col-lg-9 ps-0">
                {{ $settings['contact_intro'] ?? 'Sampaikan tujuan, tanggal, dan kebutuhan acara Anda. Tim kami akan meninjau kebutuhan tersebut dan memberikan rekomendasi yang sesuai.' }}
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
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-5">
                    <div class="card-clean p-4 p-md-5 h-100">
                        <span class="eyebrow">Informasi kontak</span>
                        <h2 class="h3 mt-2 mb-4">Saluran komunikasi resmi {{ $siteName }}.</h2>

                        <div class="d-flex flex-column gap-4">
                            <div class="d-flex gap-3">
                                <div class="icon-box flex-shrink-0"><i class="fa-solid fa-location-dot"></i></div>
                                <div>
                                    <div class="fw-semibold mb-1">Alamat kantor</div>
                                    <p class="text-secondary small mb-0">{{ $settings['address'] ?? 'Alamat kantor belum diatur.' }}</p>
                                </div>
                            </div>

                            <div class="d-flex gap-3">
                                <div class="icon-box flex-shrink-0"><i class="fa-solid fa-envelope"></i></div>
                                <div>
                                    <div class="fw-semibold mb-1">Email</div>
                                    <a class="text-secondary small text-decoration-none" href="mailto:{{ $settings['email'] ?? 'halo@linijayaevent.id' }}">{{ $settings['email'] ?? 'halo@linijayaevent.id' }}</a>
                                </div>
                            </div>

                            <div class="d-flex gap-3">
                                <div class="icon-box flex-shrink-0"><i class="fa-brands fa-whatsapp"></i></div>
                                <div>
                                    <div class="fw-semibold mb-1">WhatsApp</div>
                                    <a class="text-secondary small text-decoration-none" href="{{ $waUrl }}" target="_blank" rel="noopener">{{ $settings['whatsapp_number'] ?? '+62 812 3456 7890' }}</a>
                                </div>
                            </div>

                            <div class="d-flex gap-3">
                                <div class="icon-box flex-shrink-0"><i class="fa-regular fa-clock"></i></div>
                                <div>
                                    <div class="fw-semibold mb-1">Jam operasional</div>
                                    <p class="text-secondary small mb-0">{{ $settings['operating_hours'] ?? 'Senin–Sabtu, 08.00–17.00' }}</p>
                                </div>
                            </div>
                        </div>

                        @if ($socialLinks->isNotEmpty())
                            <div class="mt-4 pt-4" style="border-top: 1px solid var(--line)">
                                <div class="fw-semibold mb-2">Media sosial</div>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($socialLinks as $link)
                                        <a class="btn btn-ghost btn-sm d-inline-flex align-items-center gap-2" href="{{ $link->url }}" target="_blank" rel="noopener" aria-label="{{ $link->platform }}">
                                            <i class="{{ $link->icon ?: 'fa-solid fa-link' }}"></i>
                                            <span>{{ $link->platform }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card-clean p-3 p-md-4 h-100 d-flex flex-column">
                        <span class="eyebrow mb-3">Lokasi kantor</span>
                        <div class="ratio ratio-16x9 rounded-3 overflow-hidden flex-grow-1">
                            <iframe src="{{ $mapUrl }}" title="Peta lokasi {{ $siteName }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <p class="text-secondary small mt-3 mb-0">Peta mengikuti alamat kantor. Hubungi kami sebelum datang untuk memastikan titik lokasi dan jadwal layanan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-soft">
        <div class="container">
            <div class="section-head mb-4">
                <span class="eyebrow">Alur konsultasi</span>
                <h2 class="display-6 mt-2 mb-2">Tiga langkah menuju rencana acara yang matang.</h2>
                <p class="text-secondary mb-0">Konsultasi awal tidak dipungut biaya. Kami akan menindaklanjuti setiap kebutuhan dengan rekomendasi yang jelas.</p>
            </div>

            <div class="row g-3">
                @foreach ([
                    ['number' => '01', 'title' => 'Sampaikan kebutuhan', 'text' => 'Jelaskan tujuan acara, tanggal, lokasi, serta perkiraan jumlah tamu.'],
                    ['number' => '02', 'title' => 'Tinjauan & rekomendasi', 'text' => 'Kami meninjau kebutuhan Anda dan menyusun rekomendasi layanan yang sesuai.'],
                    ['number' => '03', 'title' => 'Konfirmasi rencana', 'text' => 'Rencana kerja, kebutuhan perlengkapan, dan anggaran disepakati bersama.'],
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
                        <span class="eyebrow">Mulai konsultasi</span>
                        <h2 class="display-6 text-white mt-2 mb-2">Diskusikan kebutuhan acara Anda.</h2>
                        <p class="mb-0 text-white-50">Tim {{ $siteName }} siap membantu menyusun rencana acara yang terstruktur dan sesuai anggaran Anda.</p>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-lg-end">
                        <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp me-1"></i> Hubungi Kami
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
