@props([
    'variant' => 'success', // 'success', 'danger', 'warning', 'info'
    'title' => null,
    'message' => null,
    'icon' => null,
    'id' => 'toast-'.uniqid(),
    'autohide' => true,
    'delay' => 5000,
])

@php
    $icons = [
        'success' => 'fas fa-circle-check text-success',
        'danger' => 'fas fa-circle-exclamation text-danger',
        'warning' => 'fas fa-triangle-exclamation text-warning',
        'info' => 'fas fa-circle-info text-info',
    ];
    $toastIcon = $icon ?? ($icons[$variant] ?? 'fas fa-bell text-primary');
@endphp

<div id="{{ $id }}" class="toast toast-modern shadow-lg border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="{{ $autohide ? 'true' : 'false' }}" data-bs-delay="{{ $delay }}">
    <div class="toast-header bg-white border-bottom-0 pb-0">
        <i class="{{ $toastIcon }} me-2"></i>
        <strong class="me-auto text-dark">{{ $title ?? ucfirst($variant) }}</strong>
        <small class="text-muted">Baru saja</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Tutup"></button>
    </div>
    <div class="toast-body pt-2 text-secondary">
        {{ $message ?? $slot }}
    </div>
</div>
