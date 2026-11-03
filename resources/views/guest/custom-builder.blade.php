@php
    $categoryLabels = config('rental.categories');
    $siteName = $settings['site_name'] ?? 'Lini Jaya Event';
    $waNumber = preg_replace('/\D+/', '', $settings['whatsapp_number'] ?? '6281234567890');
    $waBase = 'https://wa.me/'.$waNumber;
@endphp

<x-layouts.public
    :title="'Rancang Kebutuhan — '.$siteName"
    description="Pilih alat yang ingin disewa, tentukan jumlah crew, lalu kirim rencana kebutuhan acara Anda langsung ke WhatsApp."
    :settings="$settings"
>
    <section class="hero builder-hero">
        <div class="container">
            <div class="row align-items-end g-4">
                <div class="col-lg-8">
                    <span class="eyebrow">Rancang kebutuhan</span>
                    <h1 class="display-3 mt-2">Susun kebutuhan acara Anda.</h1>
                    <p class="lead text-secondary mt-3 mb-0">
                        Centang alat yang ingin disewa, tentukan jumlah crew, dan lengkapi detail acara.
                        Rencana Anda akan dirangkum otomatis dan dikirim ke WhatsApp kami.
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="builder-hero-stats">
                        <div>
                            <span class="stat-value">{{ $rentalItems->count() }}</span>
                            <span class="text-secondary small">alat tersedia</span>
                        </div>
                        <div>
                            <span class="stat-value">{{ $rentalCategories->count() }}</span>
                            <span class="text-secondary small">kategori</span>
                        </div>
                        <div>
                            <span class="stat-value">1</span>
                            <span class="text-secondary small">pintu konsultasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section pt-0">
        <div class="container">
            <form id="custom-builder" data-wa-base="{{ $waBase }}" data-site-name="{{ $siteName }}" novalidate>
                <div class="row g-4 g-xl-5">
                    <div class="col-lg-8">
                        <div class="builder-panel mb-4">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
                                <div>
                                    <span class="eyebrow">Langkah 1</span>
                                    <h2 class="h4 mt-2 mb-1">Pilih alat yang ingin disewa</h2>
                                    <p class="text-secondary small mb-0">Centang satu atau beberapa alat. Atur jumlah unit setelah dipilih.</p>
                                </div>
                                <div class="builder-search">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <input id="builder-search" type="search" class="form-control" placeholder="Cari alat..." aria-label="Cari alat">
                                </div>
                            </div>

                            @if ($rentalItems->isNotEmpty())
                                <div class="d-flex flex-wrap gap-2 mb-4" role="group" aria-label="Filter kategori alat">
                                    <button type="button" class="filter-chip active" data-category-filter="all">Semua</button>
                                    @foreach ($rentalCategories as $category)
                                        <button type="button" class="filter-chip" data-category-filter="{{ $category }}">
                                            {{ $categoryLabels[$category] ?? 'Lainnya' }}
                                        </button>
                                    @endforeach
                                </div>

                                <div id="builder-groups">
                                    @foreach ($rentalCategories as $category)
                                        @php $categoryItems = $rentalItems->where('category', $category); @endphp
                                        <div class="builder-group" data-builder-group data-group-category="{{ $category }}">
                                            <div class="d-flex align-items-center justify-content-between gap-3 mb-3">
                                                <h3 class="h6 mb-0">
                                                    <i class="{{ config('rental.icons.'.$category, 'fa-solid fa-box-open') }} me-2" style="color: var(--color-primary)"></i>
                                                    {{ $categoryLabels[$category] ?? 'Lainnya' }}
                                                </h3>
                                                <span class="text-secondary small">{{ $categoryItems->count() }} item</span>
                                            </div>
                                            <div class="row g-3">
                                                @foreach ($categoryItems as $item)
                                                    @php
                                                        $availability = $item->availabilityKey();
                                                        $searchText = strtolower($item->name.' '.$item->description.' '.($categoryLabels[$category] ?? ''));
                                                    @endphp
                                                    <div class="col-md-6" data-builder-item data-search="{{ $searchText }}" data-category="{{ $category }}">
                                                        <div class="builder-item">
                                                            <div class="form-check">
                                                                <input
                                                                    class="form-check-input"
                                                                    type="checkbox"
                                                                    id="item-{{ $item->id }}"
                                                                    data-item-checkbox
                                                                    data-name="{{ $item->name }}"
                                                                    data-price="{{ $item->price_per_day }}"
                                                                    data-unit="{{ $item->dailyPriceLabel() }}"
                                                                >
                                                                <label class="form-check-label" for="item-{{ $item->id }}">
                                                                    <span class="builder-item-name">{{ $item->name }}</span>
                                                                    <span class="builder-item-meta">{{ $item->dailyPriceLabel() }}</span>
                                                                    <span class="availability availability-{{ $availability }} mt-2">
                                                                        <i class="{{ $item->availabilityIcon() }}"></i>{{ $item->availabilityLabel() }}
                                                                    </span>
                                                                </label>
                                                            </div>
                                                            <div class="builder-qty">
                                                                <button type="button" data-qty-step="-1" aria-label="Kurangi jumlah {{ $item->name }}">−</button>
                                                                <input type="number" min="1" max="99" value="1" data-item-qty aria-label="Jumlah {{ $item->name }}" disabled>
                                                                <button type="button" data-qty-step="1" aria-label="Tambah jumlah {{ $item->name }}">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="builder-no-result d-none" id="builder-no-result">
                                    <i class="fa-solid fa-magnifying-glass mb-2"></i>
                                    <p class="mb-0">Tidak ada alat yang cocok dengan pencarian Anda.</p>
                                </div>
                            @else
                                <div class="builder-empty">
                                    <i class="fa-solid fa-box-open mb-3"></i>
                                    <h3 class="h5">Katalog sedang disiapkan</h3>
                                    <p class="text-secondary mb-0">Sampaikan kebutuhan alat acara Anda lewat WhatsApp, kami bantu cek ketersediaannya.</p>
                                </div>
                            @endif
                        </div>

                        <div class="builder-panel mb-4">
                            <div class="row g-4 align-items-center">
                                <div class="col-md-7">
                                    <span class="eyebrow">Langkah 2</span>
                                    <h2 class="h4 mt-2 mb-2">Butuh berapa crew?</h2>
                                    <p class="text-secondary mb-0">
                                        {{ $crewService?->description ?? 'Crew profesional untuk membantu operasional, registrasi, usher, teknis, dan koordinasi acara.' }}
                                    </p>
                                    @if ($crewService && ! empty($crewService->features))
                                        <div class="d-flex flex-wrap gap-2 mt-3">
                                            @foreach ($crewService->features as $feature)
                                                <span class="builder-tag"><i class="fa-solid fa-check me-1"></i>{{ $feature }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <div class="crew-stepper">
                                        <button type="button" data-crew-step="-1" aria-label="Kurangi jumlah crew">−</button>
                                        <div class="crew-value">
                                            <input id="crew-count" type="number" min="0" max="50" value="0" readonly aria-label="Jumlah crew">
                                            <span>orang</span>
                                        </div>
                                        <button type="button" data-crew-step="1" aria-label="Tambah jumlah crew">+</button>
                                    </div>
                                    <p class="small text-secondary text-center mt-2 mb-0">Jumlah crew bisa disesuaikan saat konsultasi.</p>
                                </div>
                            </div>
                        </div>

                        <div class="builder-panel">
                            <span class="eyebrow">Langkah 3</span>
                            <h2 class="h4 mt-2 mb-1">Detail acara</h2>
                            <p class="text-secondary small mb-4">Informasi ini membantu kami mengecek jadwal, stok, dan kebutuhan teknis.</p>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="event-date">Tanggal acara</label>
                                    <input id="event-date" type="date" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="event-location">Lokasi acara</label>
                                    <input id="event-location" type="text" class="form-control" placeholder="Kota atau nama venue">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="event-notes">Catatan kebutuhan</label>
                                    <textarea id="event-notes" rows="3" class="form-control" placeholder="Contoh: acara outdoor, butuh sound untuk 300 tamu, crew usher 4 orang."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <aside class="builder-summary">
                            <span class="eyebrow">Ringkasan</span>
                            <h2 class="h4 mt-2 mb-3">Rencana kebutuhan Anda</h2>

                            <div class="summary-empty" id="summary-empty">
                                <i class="fa-solid fa-clipboard-list mb-2"></i>
                                <p class="mb-0">Belum ada alat dipilih. Centang alat atau tambahkan crew untuk mulai menyusun rencana.</p>
                            </div>

                            <ul class="summary-items list-unstyled" id="summary-items"></ul>

                            <div class="summary-row">
                                <span>Estimasi sewa alat</span>
                                <strong id="summary-total">Rp 0 / hari</strong>
                            </div>
                            <div class="summary-row">
                                <span>Crew</span>
                                <strong id="summary-crew">Belum dipilih</strong>
                            </div>

                            <p class="small text-secondary summary-note">
                                Estimasi belum termasuk crew, transport, dan penyesuaian lokasi. Harga final dikonfirmasi tim kami.
                            </p>

                            <button type="submit" class="btn btn-main w-100" id="summary-submit" disabled>
                                <i class="fa-brands fa-whatsapp me-1"></i> Kirim Rencana ke WhatsApp
                            </button>
                            <p class="small text-secondary text-center mt-2 mb-0" id="summary-hint">Pilih minimal satu alat atau tambahkan crew.</p>

                            <button type="reset" class="btn btn-ghost w-100 mt-2" id="builder-reset">Reset pilihan</button>
                        </aside>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @push('styles')
        <style>
            .builder-hero { padding-bottom: 2.5rem; }
            .builder-hero-stats {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 12px;
                background: var(--color-bg-secondary);
                border: 1px solid var(--line);
                border-radius: 18px;
                padding: 18px;
            }
            .builder-hero-stats > div { display: flex; flex-direction: column; gap: 4px; }
            .builder-hero-stats .stat-value { font-size: 1.5rem; }
            .builder-panel {
                background: var(--color-bg-secondary);
                border: 1px solid var(--line);
                border-radius: 18px;
                padding: 24px;
            }
            .filter-chip {
                border: 1px solid var(--line);
                background: var(--color-bg);
                color: var(--color-text);
                border-radius: 100px;
                padding: .45rem .9rem;
                font-size: .85rem;
                font-weight: 600;
                transition: background .2s ease, border-color .2s ease, color .2s ease;
            }
            .filter-chip:hover,
            .filter-chip.active {
                background: var(--color-primary);
                border-color: var(--color-primary);
                color: #0d2620;
            }
            .builder-search { position: relative; min-width: 220px; }
            .builder-search i {
                position: absolute;
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--color-text-secondary);
                pointer-events: none;
            }
            .builder-search .form-control { padding-left: 38px; border-radius: 100px; }
            .builder-group + .builder-group { margin-top: 28px; padding-top: 24px; border-top: 1px solid var(--line); }
            .builder-item {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                height: 100%;
                padding: 14px;
                border: 1px solid var(--line);
                border-radius: 14px;
                background: var(--color-bg);
                transition: border-color .2s ease, background .2s ease;
            }
            .builder-item:hover { border-color: var(--line-2); }
            .builder-item.is-selected { border-color: var(--color-primary); background: var(--mint); }
            .builder-item .form-check { display: flex; align-items: flex-start; gap: 10px; margin: 0; min-width: 0; }
            .builder-item .form-check-input {
                flex-shrink: 0;
                width: 1.15rem;
                height: 1.15rem;
                margin: 2px 0 0;
                background-color: var(--color-bg-secondary);
                border: 1px solid var(--line-2);
                border-radius: 4px;
                cursor: pointer;
            }
            .builder-item .form-check-input:checked {
                background-color: var(--color-primary);
                border-color: var(--color-primary);
            }
            .builder-item .form-check-input:focus {
                border-color: var(--color-primary);
                box-shadow: 0 0 0 4px rgba(242, 178, 51, .16);
            }
            .builder-item .form-check-label { cursor: pointer; min-width: 0; }
            .builder-item-name { display: block; font-weight: 600; line-height: 1.35; }
            .builder-item-meta { display: block; color: var(--color-primary); font-size: .82rem; font-weight: 600; margin-top: 2px; }
            .builder-item .availability { font-size: .68rem; padding: .18rem .5rem; }
            .builder-qty {
                display: flex;
                align-items: center;
                flex-shrink: 0;
                border: 1px solid var(--line);
                border-radius: 10px;
                overflow: hidden;
                background: var(--color-bg-secondary);
            }
            .builder-qty button {
                width: 30px;
                height: 34px;
                border: 0;
                background: transparent;
                color: var(--color-text);
                font-size: 1rem;
                cursor: pointer;
            }
            .builder-qty button:hover { background: var(--mint); color: var(--color-primary); }
            .builder-qty input {
                width: 38px;
                height: 34px;
                border: 0;
                border-left: 1px solid var(--line);
                border-right: 1px solid var(--line);
                background: transparent;
                color: var(--color-text);
                text-align: center;
                font-weight: 600;
                -moz-appearance: textfield;
            }
            .builder-qty input::-webkit-outer-spin-button,
            .builder-qty input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
            .builder-qty input:disabled { opacity: .4; }
            .builder-no-result, .builder-empty {
                text-align: center;
                color: var(--color-text-secondary);
                padding: 32px 16px;
                border: 1px dashed var(--line-2);
                border-radius: 14px;
            }
            .builder-no-result i, .builder-empty i { font-size: 1.6rem; color: var(--color-primary); }
            .builder-tag {
                display: inline-flex;
                align-items: center;
                background: var(--mint);
                border: 1px solid var(--line);
                border-radius: 100px;
                padding: .3rem .7rem;
                font-size: .78rem;
                color: var(--color-text);
            }
            .builder-tag i { color: var(--color-secondary); }
            .crew-stepper {
                display: flex;
                align-items: stretch;
                justify-content: center;
                border: 1px solid var(--line);
                border-radius: 14px;
                overflow: hidden;
                background: var(--color-bg);
            }
            .crew-stepper button {
                width: 52px;
                border: 0;
                background: transparent;
                color: var(--color-text);
                font-size: 1.4rem;
                cursor: pointer;
                transition: background .2s ease, color .2s ease;
            }
            .crew-stepper button:hover { background: var(--color-primary); color: #0d2620; }
            .crew-value {
                flex: 1;
                display: flex;
                align-items: baseline;
                justify-content: center;
                gap: 6px;
                padding: 10px 8px;
                border-left: 1px solid var(--line);
                border-right: 1px solid var(--line);
            }
            .crew-value input {
                width: 2.6rem;
                border: 0;
                background: transparent;
                color: var(--color-primary);
                font-family: 'Funnel Display', sans-serif;
                font-size: 1.6rem;
                font-weight: 800;
                text-align: right;
                -moz-appearance: textfield;
            }
            .crew-value input::-webkit-outer-spin-button,
            .crew-value input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
            .crew-value span { color: var(--color-text-secondary); font-size: .85rem; }
            .builder-summary {
                position: sticky;
                top: 7rem;
                background: var(--mint);
                border: 1px solid var(--line-2);
                border-radius: 18px;
                padding: 24px;
            }
            .summary-empty {
                border: 1px dashed var(--line-2);
                border-radius: 14px;
                padding: 20px;
                text-align: center;
                color: var(--color-text-secondary);
                font-size: .9rem;
            }
            .summary-empty i { font-size: 1.4rem; color: var(--color-primary); display: block; }
            .summary-items { margin: 0 0 16px; }
            .summary-items li {
                display: flex;
                justify-content: space-between;
                gap: 12px;
                padding: 10px 0;
                border-bottom: 1px solid var(--line);
                font-size: .9rem;
            }
            .summary-items li:first-child { padding-top: 0; }
            .summary-items .summary-item-name { font-weight: 600; }
            .summary-items .summary-item-qty { color: var(--color-text-secondary); font-size: .8rem; }
            .summary-items .summary-item-price { color: var(--color-primary); font-weight: 600; white-space: nowrap; }
            .summary-row {
                display: flex;
                justify-content: space-between;
                gap: 12px;
                padding: 8px 0;
                border-top: 1px solid var(--line);
                font-size: .9rem;
            }
            .summary-row strong { color: var(--color-primary); }
            .summary-note { margin: 12px 0 16px; }
            .builder-summary .btn-main:disabled { opacity: .45; filter: none; cursor: not-allowed; }
            .builder-summary .form-control { color-scheme: dark; }
            .builder-panel .form-control { color-scheme: dark; }
            @media (max-width: 991.98px) {
                .builder-summary { position: static; }
            }
            @media (max-width: 575.98px) {
                .builder-panel, .builder-summary { padding: 18px; }
                .builder-hero-stats { grid-template-columns: repeat(3, minmax(0, 1fr)); }
                .builder-item { flex-direction: column; align-items: stretch; }
                .builder-qty { align-self: flex-end; }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            (() => {
                const form = document.getElementById('custom-builder');
                if (!form) return;

                const items = Array.from(form.querySelectorAll('[data-builder-item]'));
                const categoryButtons = Array.from(form.querySelectorAll('[data-category-filter]'));
                const searchInput = document.getElementById('builder-search');
                const noResult = document.getElementById('builder-no-result');
                const summaryItems = document.getElementById('summary-items');
                const summaryEmpty = document.getElementById('summary-empty');
                const summaryTotal = document.getElementById('summary-total');
                const summaryCrew = document.getElementById('summary-crew');
                const submitButton = document.getElementById('summary-submit');
                const summaryHint = document.getElementById('summary-hint');
                const crewInput = document.getElementById('crew-count');
                const rupiah = new Intl.NumberFormat('id-ID');

                let activeCategory = 'all';

                const selectedItems = () => items
                    .filter((item) => item.querySelector('[data-item-checkbox]').checked)
                    .map((item) => {
                        const checkbox = item.querySelector('[data-item-checkbox]');
                        const qty = item.querySelector('[data-item-qty]');

                        return {
                            name: checkbox.dataset.name,
                            price: Number(checkbox.dataset.price) || 0,
                            unit: checkbox.dataset.unit,
                            qty: Math.max(1, Number(qty.value) || 1),
                        };
                    });

                const formatRupiah = (value) => 'Rp ' + rupiah.format(value);

                const syncItem = (item) => {
                    const checkbox = item.querySelector('[data-item-checkbox]');
                    const qty = item.querySelector('[data-item-qty]');
                    const wrapper = item.querySelector('.builder-item');

                    qty.disabled = !checkbox.checked;
                    wrapper.classList.toggle('is-selected', checkbox.checked);
                };

                const updateSummary = () => {
                    const selected = selectedItems();
                    const crew = Math.max(0, Number(crewInput.value) || 0);
                    const total = selected.reduce((sum, item) => sum + item.price * item.qty, 0);

                    summaryItems.innerHTML = '';
                    selected.forEach((item) => {
                        const row = document.createElement('li');
                        const label = document.createElement('div');
                        const name = document.createElement('div');
                        const qty = document.createElement('div');

                        name.className = 'summary-item-name';
                        name.textContent = item.name;
                        qty.className = 'summary-item-qty';
                        qty.textContent = item.qty + ' unit · ' + item.unit;
                        label.append(name, qty);

                        const price = document.createElement('span');
                        price.className = 'summary-item-price';
                        price.textContent = item.price > 0 ? formatRupiah(item.price * item.qty) : 'Cek harga';

                        row.append(label, price);
                        summaryItems.appendChild(row);
                    });

                    summaryEmpty.classList.toggle('d-none', selected.length > 0);
                    summaryTotal.textContent = selected.length > 0 && total === 0
                        ? 'Cek harga'
                        : formatRupiah(total) + ' / hari';
                    summaryCrew.textContent = crew > 0 ? crew + ' orang' : 'Belum dipilih';

                    const hasSelection = selected.length > 0 || crew > 0;
                    submitButton.disabled = !hasSelection;
                    summaryHint.textContent = hasSelection
                        ? 'Rencana akan dikirim ke WhatsApp untuk dicek tim kami.'
                        : 'Pilih minimal satu alat atau tambahkan crew.';
                };

                const applyFilter = () => {
                    const term = (searchInput?.value || '').trim().toLowerCase();

                    items.forEach((item) => {
                        const matchesCategory = activeCategory === 'all' || item.dataset.category === activeCategory;
                        const matchesSearch = !term || item.dataset.search.includes(term);
                        item.classList.toggle('d-none', !(matchesCategory && matchesSearch));
                    });

                    form.querySelectorAll('[data-builder-group]').forEach((group) => {
                        const hasVisibleItem = Array.from(group.querySelectorAll('[data-builder-item]'))
                            .some((item) => !item.classList.contains('d-none'));
                        group.classList.toggle('d-none', !hasVisibleItem);
                    });

                    if (noResult) {
                        const hasAnyVisible = items.some((item) => !item.classList.contains('d-none'));
                        noResult.classList.toggle('d-none', hasAnyVisible);
                    }
                };

                items.forEach((item) => {
                    const checkbox = item.querySelector('[data-item-checkbox]');
                    const qty = item.querySelector('[data-item-qty]');

                    checkbox.addEventListener('change', () => {
                        syncItem(item);
                        updateSummary();
                    });

                    qty.addEventListener('change', () => {
                        qty.value = Math.min(99, Math.max(1, Number(qty.value) || 1));
                        updateSummary();
                    });

                    item.querySelectorAll('[data-qty-step]').forEach((button) => {
                        button.addEventListener('click', () => {
                            const next = Math.min(99, Math.max(1, (Number(qty.value) || 1) + Number(button.dataset.qtyStep)));
                            qty.value = next;

                            if (!checkbox.checked) {
                                checkbox.checked = true;
                            }

                            syncItem(item);
                            updateSummary();
                        });
                    });
                });

                form.querySelectorAll('[data-crew-step]').forEach((button) => {
                    button.addEventListener('click', () => {
                        crewInput.value = Math.min(50, Math.max(0, (Number(crewInput.value) || 0) + Number(button.dataset.crewStep)));
                        updateSummary();
                    });
                });

                categoryButtons.forEach((button) => {
                    button.addEventListener('click', () => {
                        activeCategory = button.dataset.categoryFilter;
                        categoryButtons.forEach((chip) => chip.classList.toggle('active', chip === button));
                        applyFilter();
                    });
                });

                searchInput?.addEventListener('input', applyFilter);

                form.addEventListener('reset', () => {
                    window.setTimeout(() => {
                        items.forEach((item) => {
                            item.querySelector('[data-item-qty]').value = 1;
                            item.querySelector('[data-item-checkbox]').checked = false;
                            syncItem(item);
                        });

                        crewInput.value = 0;
                        activeCategory = 'all';
                        categoryButtons.forEach((chip) => chip.classList.toggle('active', chip.dataset.categoryFilter === 'all'));

                        if (searchInput) {
                            searchInput.value = '';
                        }

                        applyFilter();
                        updateSummary();
                    }, 0);
                });

                form.addEventListener('submit', (event) => {
                    event.preventDefault();

                    const selected = selectedItems();
                    const crew = Math.max(0, Number(crewInput.value) || 0);
                    const date = document.getElementById('event-date').value;
                    const location = document.getElementById('event-location').value.trim();
                    const notes = document.getElementById('event-notes').value.trim();

                    if (selected.length === 0 && crew === 0) {
                        return;
                    }

                    const total = selected.reduce((sum, item) => sum + item.price * item.qty, 0);
                    const lines = [
                        'Halo ' + form.dataset.siteName + ', saya ingin merancang kebutuhan acara.',
                        '',
                    ];

                    if (selected.length > 0) {
                        lines.push('*Alat yang ingin disewa:*');
                        selected.forEach((item, index) => {
                            lines.push((index + 1) + '. ' + item.name + ' — ' + item.qty + ' unit — ' + item.unit);
                        });

                        if (total > 0) {
                            lines.push('');
                            lines.push('*Estimasi sewa alat:* ' + formatRupiah(total) + ' / hari');
                        }
                    }

                    if (crew > 0) {
                        lines.push('*Crew yang dibutuhkan:* ' + crew + ' orang');
                    }

                    if (date) {
                        const formattedDate = new Date(date + 'T00:00:00').toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                        });
                        lines.push('*Tanggal acara:* ' + formattedDate);
                    }

                    if (location) {
                        lines.push('*Lokasi acara:* ' + location);
                    }

                    if (notes) {
                        lines.push('*Catatan:* ' + notes);
                    }

                    lines.push('', 'Mohon info ketersediaan, harga final, dan penawaran terbaiknya.');

                    const url = form.dataset.waBase + '?text=' + encodeURIComponent(lines.join('\n'));
                    window.open(url, '_blank', 'noopener');
                });

                const preselected = (new URLSearchParams(window.location.search).get('alat') || '')
                    .split(',')
                    .map((id) => id.trim())
                    .filter(Boolean);

                preselected.forEach((id) => {
                    const checkbox = document.getElementById('item-' + id);
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                });

                items.forEach(syncItem);
                updateSummary();
            })();
        </script>
    @endpush
</x-layouts.public>
