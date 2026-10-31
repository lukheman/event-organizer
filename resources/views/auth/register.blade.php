<x-layouts.guest title="Daftar Akun Admin — Nusa Event" type="auth">
    <div class="login-container">
        <div class="login-card">
            <!-- Brand Logo -->
            <div class="brand-logo">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <span class="brand-kicker">Panel Admin</span>
                <h1>Buat akun pengelola</h1>
                <p>Daftarkan akun untuk mengelola katalog sewa.</p>
            </div>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register.store') }}" id="register-form">
                @csrf

                <!-- Name Field -->
                <div class="form-floating position-relative">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Nama lengkap" autocomplete="name" required autofocus>
                    <label for="name">Nama lengkap</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-floating position-relative">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Alamat email" autocomplete="email" required>
                    <label for="email">Alamat email</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-floating position-relative">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Kata sandi" autocomplete="new-password" required>
                    <label for="password">Kata sandi</label>
                    <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')" aria-label="Tampilkan kata sandi">
                        <i class="fas fa-eye" id="toggleIcon1"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="form-floating position-relative">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password_confirmation" class="form-control"
                        id="password_confirmation" placeholder="Konfirmasi kata sandi"
                        autocomplete="new-password" required>
                    <label for="password_confirmation">Konfirmasi kata sandi</label>
                    <button type="button" class="password-toggle"
                        onclick="togglePassword('password_confirmation', 'toggleIcon2')" aria-label="Tampilkan kata sandi">
                        <i class="fas fa-eye" id="toggleIcon2"></i>
                    </button>
                </div>

                <!-- Terms and Conditions -->
                <div class="form-check mb-4">
                    <input class="form-check-input @error('agree_terms') is-invalid @enderror" type="checkbox"
                        name="agree_terms" value="1" id="agree_terms" @checked(old('agree_terms')) required>
                    <label class="form-check-label" for="agree_terms">
                        Saya menyetujui syarat penggunaan dan kebijakan privasi.
                    </label>
                    @error('agree_terms')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Register Button -->
                <button type="submit" class="btn btn-login" id="register-button">
                    <span id="register-text">Buat akun <i class="fas fa-arrow-right"></i></span>
                    <span id="register-loading" class="d-none">
                        <i class="fas fa-spinner fa-spin me-2"></i> Membuat akun...
                    </span>
                </button>
            </form>

            <!-- Sign In Link -->
            <div class="signup-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
            </div>
        </div>

        <p class="login-footer">
            <i class="fa-solid fa-lock"></i>
            Area khusus pengelola website Nusa Event.
        </p>
    </div>

    @push('styles')
        <style>
            .login-footer {
                text-align: center;
                margin-top: 1.25rem;
                margin-bottom: 0;
                color: rgba(230, 243, 239, .75);
                font-size: .85rem;
                position: relative;
                z-index: 1;
            }

            .login-footer i {
                color: #d99b4b;
                margin-right: .35rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            function togglePassword(inputId, iconId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            }

            document.getElementById('register-form').addEventListener('submit', function () {
                document.getElementById('register-button').disabled = true;
                document.getElementById('register-text').classList.add('d-none');
                document.getElementById('register-loading').classList.remove('d-none');
            });
        </script>
    @endpush
</x-layouts.guest>
