@php
    $photo = $item->photoUrl();
    $siteName = $settings['site_name'] ?? 'Lini Jaya Event';
    $waBase = \App\Support\SiteContent::whatsappUrl($settings);
@endphp

<x-layouts.public :title="$item->name.' — '.$siteName" :settings="$settings">
    <main class="rental-detail">
        <div class="container rental-detail-content">
            <a href="{{ route('home') }}#katalog" class="back-link"><i class="fa-solid fa-arrow-left me-2"></i>Kembali ke katalog</a>
            
            <div class="row align-items-center g-5 mt-2">
                <div class="col-lg-6">
                    <div class="rental-detail-photo">
                        @if ($photo)
                            <img src="{{ $photo }}" alt="Foto {{ $item->name }}">
                        @else
                            <i class="{{ $item->categoryIcon() }}"></i>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="eyebrow">{{ $item->categoryLabel() }}</span>
                    <h1 class="display-5 mt-2">{{ $item->name }}</h1>
                    
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="availability availability-{{ $item->availabilityKey() }}">
                            <i class="{{ $item->availabilityIcon() }} me-1"></i>{{ $item->availabilityLabel() }}
                        </span>
                        <span class="text-secondary small">· Siap untuk kebutuhan acara Anda</span>
                    </div>

                    <p class="text-secondary mt-3">{{ $item->description }}</p>
                    
                    <div class="rental-price">{{ $item->dailyPriceLabel() }}</div>
                    <p class="text-secondary small mb-4">Tarif dapat menyesuaikan jumlah unit dan lokasi pengantaran.</p>

                    <!-- Form Booking Langsung ke WhatsApp -->
                    <form id="rental-booking" class="booking-form">
                        <div class="row g-3">
                            <div class="col-sm-4">
                                <label for="quantity">Jumlah Unit</label>
                                <div class="quantity-control">
                                    <button type="button" data-quantity="-1" aria-label="Kurangi jumlah">−</button>
                                    <input id="quantity" type="number" value="1" min="1" readonly>
                                    <button type="button" data-quantity="1" aria-label="Tambah jumlah">+</button>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label for="rental-date">Tanggal Acara</label>
                                <input id="rental-date" type="date" value="{{ now()->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="duration">Durasi Sewa</label>
                                <select id="duration">
                                    @for ($day = 1; $day <= 14; $day++)
                                        <option value="{{ $day }}">{{ $day }} Hari</option>
                                    @endfor
                                    <option value="30">1 Bulan</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <button type="submit" class="btn btn-main flex-grow-1">
                                <i class="fa-brands fa-whatsapp me-2"></i>Booking via WhatsApp
                            </button>
                            <a href="{{ \App\Support\SiteContent::whatsappUrl($settings, 'Halo, saya ingin konsultasi teknis mengenai '.$item->name.'.') }}" target="_blank" rel="noopener" class="btn btn-ghost">
                                <i class="fa-regular fa-comment-dots me-1"></i> Tanya Spesifikasi
                            </a>
                        </div>
                    </form>

                    <a href="{{ route('custom', ['alat' => $item->id]) }}" class="text-link small d-inline-block mt-3">
                        <i class="fa-solid fa-list-check me-1"></i> Susun rencana dengan alat ini
                    </a>

                    <!-- Poin Kepercayaan -->
                    <div class="row g-3 mt-4 pt-3 border-top">
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center gap-2 text-secondary small">
                                <i class="fa-solid fa-truck-fast" style="color: var(--teal)"></i>
                                <span>Antar & Pasang</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center gap-2 text-secondary small">
                                <i class="fa-solid fa-screwdriver-wrench" style="color: var(--teal)"></i>
                                <span>Stok Teruji</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center gap-2 text-secondary small">
                                <i class="fa-solid fa-headset" style="color: var(--teal)"></i>
                                <span>Teknisi Siaga</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item Terkait di Kategori yang Sama -->
            @if (isset($relatedItems) && $relatedItems->isNotEmpty())
                <div class="mt-5 pt-5 border-top">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <span class="eyebrow">Item Sejenis</span>
                            <h2 class="h4 mt-1 mb-0">Pilihan Lain di Kategori {{ $item->categoryLabel() }}</h2>
                        </div>
                        <a href="{{ route('home') }}#katalog" class="text-link">Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>

                    <div class="row g-4">
                        @foreach ($relatedItems as $related)
                            <div class="col-md-4">
                                <a href="{{ route('rental-items.show', $related) }}" class="card-clean p-3 d-flex flex-column text-decoration-none text-dark h-100">
                                    <div class="media-frame mb-3 position-relative">
                                        @if ($related->photoUrl())
                                            <img src="{{ $related->photoUrl() }}" alt="Foto {{ $related->name }}" loading="lazy">
                                        @else
                                            <i class="{{ $related->categoryIcon() }}"></i>
                                        @endif
                                        <span class="availability availability-{{ $related->availabilityKey() }} position-absolute top-0 end-0 m-2">
                                            <i class="{{ $related->availabilityIcon() }}"></i>{{ $related->availabilityLabel() }}
                                        </span>
                                    </div>
                                <span class="eyebrow mb-1">{{ $related->categoryLabel() }}</span>
                                <h3 class="h6 mb-2">{{ $related->name }}</h3>
                                <div class="fw-semibold mb-2" style="color: var(--color-primary)">{{ $related->dailyPriceLabel() }}</div>
                                <p class="text-secondary small mb-0">{{ \Illuminate\Support\Str::limit($related->description, 80) }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </main>

    @push('styles')
        <style>
            .rental-detail { min-height: 100vh; padding: 8rem 0 5rem; position: relative; background: var(--color-bg); overflow: hidden; }
            .rental-detail-content { position: relative; z-index: 1; }
            .back-link { color: var(--color-text-secondary); text-decoration: none; font-weight: 500; }
            .back-link:hover { color: var(--color-primary); }
            .rental-detail-photo { aspect-ratio: 4 / 3; border-radius: 18px; overflow: hidden; background: var(--mint); display: grid; place-items: center; box-shadow: rgba(0, 0, 0, .4) 0 14px 34px 0; }
            .rental-detail-photo img { width: 100%; height: 100%; object-fit: cover; }
            .rental-detail-photo i { font-size: 5rem; color: var(--color-primary); }
            .rental-price { color: var(--color-primary); font-size: 1.25rem; font-weight: 600; }
            .booking-form label { display: block; color: var(--color-text); font-size: .8rem; font-weight: 600; margin-bottom: .4rem; }
            .booking-form input, .booking-form select { width: 100%; border: 1px solid var(--line); border-radius: 10px; padding: .75rem .85rem; background: var(--color-bg-secondary); color: var(--color-text); font-weight: 500; }
            .quantity-control { display: flex; background: var(--color-bg-secondary); border: 1px solid var(--line); border-radius: 10px; overflow: hidden; }
            .quantity-control button { width: 2.75rem; border: 0; background: var(--color-primary); color: #0d2620; font-size: 1.25rem; font-weight: bold; cursor: pointer; transition: background .2s; }
            .quantity-control button:hover { filter: brightness(1.08); }
            .quantity-control input { text-align: center; border-radius: 0; }
            @media (max-width: 767px) { .rental-detail { padding-top: 6.5rem; } }
        </style>
    @endpush
    @push('scripts')
        <script>
            const quantityInput = document.getElementById('quantity');
            document.querySelectorAll('[data-quantity]').forEach(button => button.addEventListener('click', () => {
                quantityInput.value = Math.max(1, Number(quantityInput.value) + Number(button.dataset.quantity));
            }));
            document.getElementById('rental-booking').addEventListener('submit', event => {
                event.preventDefault();
                const date = document.getElementById('rental-date').value;
                const duration = document.getElementById('duration').value;
                const message = `Halo, saya ingin booking {{ addslashes($item->name) }}. Jumlah: ${quantityInput.value} unit. Tanggal sewa: ${date}. Durasi: ${duration} hari. Mohon info ketersediaan dan penawaran harganya.`;
                window.open('{{ $waBase }}&text=' + encodeURIComponent(message), '_blank', 'noopener');
            });
        </script>
    @endpush
</x-layouts.public>
