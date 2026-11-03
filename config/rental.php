<?php

return [
    'categories' => [
        'tenda' => 'Tenda & Venue',
        'sound' => 'Sound System',
        'lighting' => 'Lighting',
        'furniture' => 'Kursi & Meja',
        'multimedia' => 'Multimedia',
        'power' => 'Daya & Genset',
        'lainnya' => 'Lainnya',
    ],

    'icons' => [
        'tenda' => 'fa-solid fa-tent',
        'sound' => 'fa-solid fa-volume-high',
        'lighting' => 'fa-solid fa-lightbulb',
        'furniture' => 'fa-solid fa-chair',
        'multimedia' => 'fa-solid fa-video',
        'power' => 'fa-solid fa-bolt',
        'lainnya' => 'fa-solid fa-box-open',
    ],

    'availability' => [
        'available' => [
            'label' => 'Tersedia',
            'icon' => 'fa-solid fa-circle-check',
            'hint' => 'Siap dikirim sesuai jadwal acara.',
            'cta' => 'Sewa sekarang',
        ],
        'limited' => [
            'label' => 'Terbatas',
            'icon' => 'fa-solid fa-triangle-exclamation',
            'hint' => 'Cek stok terbatas',
            'cta' => 'Cek stok terbatas',
        ],
        'unavailable' => [
            'label' => 'Tidak tersedia',
            'icon' => 'fa-solid fa-circle-xmark',
            'hint' => 'Sedang dipakai atau dalam perawatan.',
            'cta' => 'Tanya jadwal berikutnya',
        ],
    ],
];
