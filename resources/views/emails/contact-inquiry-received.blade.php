<h1>Inquiry kontak baru</h1>

<p><strong>Nama:</strong> {{ $inquiry->name }}</p>
<p><strong>Email:</strong> {{ $inquiry->email ?: '-' }}</p>
<p><strong>WhatsApp:</strong> {{ $inquiry->whatsapp ?: '-' }}</p>
<p><strong>Jenis acara:</strong> {{ $inquiry->event_type }}</p>
<p><strong>Tanggal acara:</strong> {{ $inquiry->event_date?->format('d-m-Y') ?: '-' }}</p>
<p><strong>Pesan:</strong></p>
<p>{!! nl2br(e($inquiry->message)) !!}</p>
