@php
    $siteName = $settings['site_name'] ?? 'Lini Jaya Event';
    $waUrl = \App\Support\SiteContent::whatsappUrl($settings, 'Halo, saya ingin berkonsultasi mengenai rencana acara dengan tim '.$siteName.'.');
@endphp

<x-layouts.public :title="'Tentang Kami — '.$siteName" :settings="$settings">
    <section class="hero">
        <div class="container">
            <div class="eyebrow">Tentang kami · Profil perusahaan</div>
            <h1 class="display-4 mt-2">{{ $siteName }} — mitra penyelenggaraan acara yang terencana.</h1>
            <p class="lead text-secondary mt-3 col-lg-9 ps-0">
                Kami mendukung instansi, perusahaan, lembaga pendidikan, dan komunitas dalam merencanakan serta melaksanakan acara secara terstruktur, efisien, dan sesuai tujuan.
            </p>
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
            <div class="row g-4 align-items-stretch mb-5">
                <div class="col-lg-8">
                    <div class="card-clean p-4 p-md-5 h-100">
                        <span class="eyebrow">Siapa kami</span>
                        <h2 class="display-6 mt-2 mb-3">Satu tim untuk perencanaan, produksi, dan pelaksanaan acara.</h2>
                        <p class="text-secondary mb-3">
                            {{ $settings['about'] ?? 'Lini Jaya Event adalah partner event organizer untuk instansi, sekolah, perusahaan, dan komunitas. Kami membantu merancang konsep, mengelola produksi, menjalankan operasional, serta menyediakan perlengkapan agar setiap acara terlaksana dengan rapi dan berkesan.' }}
                        </p>
                        <p class="text-secondary mb-0">
                            Setiap kerja sama dimulai dengan pemahaman terhadap tujuan acara, dilanjutkan dengan penyusunan rencana kerja yang terukur, dan dieksekusi melalui koordinasi tim yang responsif. Seluruh proses didokumentasikan agar keputusan dapat diambil secara tepat dan hasilnya dapat dievaluasi.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-clean p-4 h-100">
                        <span class="eyebrow">Informasi perusahaan</span>
                        <h2 class="h5 mt-2 mb-3">{{ $siteName }}</h2>
                        <div class="d-flex flex-column gap-3 small text-secondary">
                            <span class="d-flex gap-2">
                                <i class="fa-solid fa-location-dot mt-1" style="color: var(--color-primary)"></i>
                                <span>{{ $settings['address'] ?? 'Alamat kantor belum diatur.' }}</span>
                            </span>
                            <span class="d-flex gap-2">
                                <i class="fa-regular fa-clock mt-1" style="color: var(--color-primary)"></i>
                                <span>{{ $settings['operating_hours'] ?? 'Senin–Sabtu, 08.00–17.00' }}</span>
                            </span>
                            <span class="d-flex gap-2">
                                <i class="fa-solid fa-envelope mt-1" style="color: var(--color-primary)"></i>
                                <a class="text-decoration-none" style="color: inherit" href="mailto:{{ $settings['email'] ?? 'halo@linijayaevent.id' }}">{{ $settings['email'] ?? 'halo@linijayaevent.id' }}</a>
                            </span>
                            <span class="d-flex gap-2">
                                <i class="fa-brands fa-whatsapp mt-1" style="color: var(--color-primary)"></i>
                                <a class="text-decoration-none" style="color: inherit" href="{{ $waUrl }}" target="_blank" rel="noopener">Konsultasi via WhatsApp</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="card-clean p-4 h-100">
                        <div class="icon-box mb-3"><i class="fa-solid fa-bullseye"></i></div>
                        <h2 class="h4">Visi Kami</h2>
                        <p class="text-secondary mb-0">
                            {{ $settings['vision'] ?? 'Menjadi partner event organizer dan penyedia perlengkapan acara yang paling andal.' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-clean p-4 h-100">
                        <div class="icon-box mb-3"><i class="fa-solid fa-compass"></i></div>
                        <h2 class="h4">Misi Kami</h2>
                        <p class="text-secondary mb-0">
                            {{ $settings['mission'] ?? 'Menghadirkan perencanaan terstruktur, produksi yang presisi, tim yang responsif, dan perlengkapan terawat untuk setiap acara.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="section-head mb-4">
                <span class="eyebrow">Lingkup kerja</span>
                <h2 class="display-6 mt-2 mb-2">Dari perencanaan konsep hingga kesiapan operasional di lokasi.</h2>
                <p class="text-secondary mb-0">Peran kami dapat disesuaikan dengan kebutuhan Anda, baik sebagai perencana, pelaksana, maupun penyedia perlengkapan acara.</p>
            </div>

            <div class="row g-4 mb-5">
                @foreach ([
                    ['icon' => 'fa-lightbulb', 'title' => 'Perencanaan & konsep', 'desc' => 'Penyusunan konsep acara, rundown, kebutuhan anggaran, dan rencana kerja yang terukur.'],
                    ['icon' => 'fa-gears', 'title' => 'Produksi & perlengkapan', 'desc' => 'Penyediaan panggung, tata suara, tata cahaya, tenda, kursi, dan perlengkapan acara lainnya.'],
                    ['icon' => 'fa-people-group', 'title' => 'Operasional acara', 'desc' => 'Koordinasi crew, registrasi, kebutuhan teknis, dan alur acara pada hari pelaksanaan.'],
                ] as $pillar)
                    <div class="col-md-4">
                        <div class="card-clean p-4 h-100">
                            <div class="icon-box mb-3"><i class="fa-solid {{ $pillar['icon'] }}"></i></div>
                            <h3 class="h5">{{ $pillar['title'] }}</h3>
                            <p class="text-secondary small mb-0">{{ $pillar['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="section-head mb-4">
                <span class="eyebrow">Keunggulan kami</span>
                <h2 class="display-6 mt-2 mb-2">Alasan mempercayakan acara Anda kepada {{ $siteName }}.</h2>
                <p class="text-secondary mb-0">Kami menempatkan kualitas eksekusi, kesiapan teknis, dan komunikasi yang terbuka sebagai dasar setiap kerja sama.</p>
            </div>

            <div class="row g-4 mb-5">
                @foreach ([
                    ['icon' => 'fa-medal', 'title' => 'Pengalaman & profesionalisme', 'desc' => 'Tim yang terbiasa menangani pernikahan, acara formal, hingga pertemuan berskala besar.'],
                    ['icon' => 'fa-shield-halved', 'title' => 'Perlengkapan terawat', 'desc' => 'Perlengkapan diperiksa dan diuji secara berkala untuk memastikan kesiapan selama acara.'],
                    ['icon' => 'fa-truck-fast', 'title' => 'Ketepatan pengiriman & instalasi', 'desc' => 'Instalasi diselesaikan sebelum gladi resik atau pembukaan acara dimulai.'],
                    ['icon' => 'fa-comments', 'title' => 'Konsultasi yang solutif', 'desc' => 'Kebutuhan Anda dipetakan secara menyeluruh, disertai rekomendasi yang efisien dan sesuai anggaran.'],
                ] as $value)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card-clean p-4 h-100">
                            <div class="icon-box mb-3"><i class="fa-solid {{ $value['icon'] }}"></i></div>
                            <h3 class="h6">{{ $value['title'] }}</h3>
                            <p class="text-secondary small mb-0">{{ $value['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($teamMembers->isNotEmpty())
                <div class="section-head mb-4">
                    <span class="eyebrow">Tim kami</span>
                    <h2 class="display-6 mt-2 mb-2">Tim yang mendampingi setiap tahap acara.</h2>
                    <p class="text-secondary mb-0">Sinergi tim perencanaan, operasional, dan teknis memastikan setiap tahap berjalan sesuai rencana.</p>
                </div>

                <div class="row g-4">
                    @foreach ($teamMembers as $member)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="card-clean p-3 text-center h-100 d-flex flex-column align-items-center">
                                <div class="ratio ratio-1x1 rounded-3 overflow-hidden mb-3 w-100" style="max-width: 220px; background: var(--mint);">
                                    @if ($member->photoUrl())
                                        <img src="{{ $member->photoUrl() }}" alt="{{ $member->name }}" class="w-100 h-100" style="object-fit: cover;" loading="lazy">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <i class="fa-solid fa-user-tie fa-3x" style="color: var(--color-primary);"></i>
                                        </div>
                                    @endif
                                </div>
                                <h3 class="h6 mb-1">{{ $member->name }}</h3>
                                <p class="text-secondary small mb-0">{{ $member->position }}</p>
                            </div>
                        </div>
                    @endforeach
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
</x-layouts.public>
