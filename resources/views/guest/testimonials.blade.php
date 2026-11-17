@php
    $siteName = $settings['site_name'] ?? 'LinyEO';
    $waUrl = \App\Support\SiteContent::whatsappUrl($settings, 'Halo, saya ingin berkonsultasi mengenai rencana acara dengan tim '.$siteName.'.');
    $testimonialCount = $testimonials->count();
    $averageRating = $testimonialCount > 0 ? round($testimonials->avg('rating') ?? 5, 1) : null;
@endphp

<x-layouts.public :title="'Testimoni — '.$siteName" :settings="$settings">
    <section class="hero">
        <div class="container">
            <div class="eyebrow">Testimoni · Pengalaman mitra</div>
            <h1 class="display-4 mt-2">Kepercayaan mitra menjadi standar layanan kami.</h1>
            <p class="lead text-secondary mt-3 col-lg-9 ps-0">
                Setiap penilaian menjadi bahan evaluasi untuk mempertahankan kualitas perencanaan, kesiapan perlengkapan, dan ketepatan pelaksanaan acara.
            </p>

            @if ($testimonialCount > 0)
                <div class="hero-stats mt-4">
                    <div>
                        <div class="stat-value">{{ $testimonialCount }}</div>
                        <div class="small text-secondary">Mitra memberikan penilaian</div>
                    </div>
                    <div>
                        <div class="stat-value">{{ number_format($averageRating, 1, ',', '.') }}/5</div>
                        <div class="small text-secondary">Rata-rata penilaian</div>
                    </div>
                </div>
            @endif

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">
                    <i class="fa-brands fa-whatsapp me-1"></i> Konsultasi via WhatsApp
                </a>
                <a class="btn btn-ghost" href="{{ route('collaborations') }}">
                    <i class="fa-solid fa-handshake-angle me-1"></i> Lihat Rekam Jejak
                </a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head mb-4">
                <span class="eyebrow">Penilaian mitra</span>
                <h2 class="display-6 mt-2 mb-2">Apa yang mitra sampaikan tentang layanan kami.</h2>
                <p class="text-secondary mb-0">Umpan balik berikut disampaikan oleh instansi, perusahaan, dan komunitas yang telah bekerja sama dengan {{ $siteName }}.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            <div class="card-clean p-4 p-md-5 mb-4">
                <span class="eyebrow">Bagikan pengalaman</span>
                <h2 class="h4 mt-2">Tulis testimoni Anda</h2>
                <p class="text-secondary">Testimoni akan ditinjau sebelum ditampilkan.</p>
                <form method="POST" action="{{ route('testimonials.store') }}" class="row g-3">
                    @csrf
                    <div class="col-md-6"><label class="form-label" for="testimonial-name">Nama</label><input id="testimonial-name" name="name" class="form-control" required value="{{ old('name') }}"></div>
                    <div class="col-md-6"><label class="form-label" for="testimonial-organization">Organisasi</label><input id="testimonial-organization" name="organization" class="form-control" value="{{ old('organization') }}"></div>
                    <div class="col-md-4"><label class="form-label" for="testimonial-rating">Rating</label><select id="testimonial-rating" name="rating" class="form-select" required>@for ($rating = 5; $rating >= 1; $rating--)<option value="{{ $rating }}">{{ $rating }} / 5</option>@endfor</select></div>
                    <div class="col-12"><label class="form-label" for="testimonial-comment">Komentar</label><textarea id="testimonial-comment" name="comment" rows="4" class="form-control" required>{{ old('comment') }}</textarea></div>
                    <div class="col-12"><button class="btn btn-main" type="submit">Kirim testimoni</button></div>
                </form>
            </div>

            <div class="row g-4">
                @forelse ($testimonials as $testimonial)
                    <div class="col-md-6 col-lg-4">
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
                            <h3 class="h5">Testimoni sedang kami himpun</h3>
                            <p class="text-secondary mb-3">Penilaian mitra akan ditampilkan pada bagian ini setelah proses evaluasi selesai.</p>
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
                <span class="eyebrow">Standar layanan</span>
                <h2 class="display-6 mt-2 mb-2">Dasar penilaian yang kami jaga.</h2>
                <p class="text-secondary mb-0">Kualitas layanan tidak hanya dinilai pada hari pelaksanaan, tetapi juga pada proses koordinasi sebelum dan sesudah acara.</p>
            </div>

            <div class="row g-3">
                @foreach ([
                    ['icon' => 'fa-comments', 'title' => 'Komunikasi yang responsif', 'text' => 'Setiap pertanyaan dan perubahan kebutuhan ditanggapi secara jelas dan tepat waktu.'],
                    ['icon' => 'fa-clock', 'title' => 'Eksekusi sesuai jadwal', 'text' => 'Pengiriman, instalasi, dan alur acara diselesaikan sesuai rencana yang disepakati.'],
                    ['icon' => 'fa-clipboard-check', 'title' => 'Evaluasi pasca-acara', 'text' => 'Umpan balik mitra digunakan untuk memperbaiki kualitas layanan berikutnya.'],
                ] as $value)
                    <div class="col-md-4">
                        <div class="card-clean p-4 h-100">
                            <div class="icon-box mb-3"><i class="fa-solid {{ $value['icon'] }}"></i></div>
                            <h3 class="h6">{{ $value['title'] }}</h3>
                            <p class="text-secondary small mb-0">{{ $value['text'] }}</p>
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
                        <span class="eyebrow">Kerja sama berikutnya</span>
                        <h2 class="display-6 text-white mt-2 mb-2">Jadilah mitra berikutnya.</h2>
                        <p class="mb-0 text-white-50">Sampaikan kebutuhan acara Anda. Tim {{ $siteName }} akan membantu menyusun rencana yang terstruktur dan sesuai anggaran.</p>
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
