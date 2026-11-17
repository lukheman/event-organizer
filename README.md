# Laravel Admin Dashboard Template

A modern, elegant admin dashboard template built with Laravel 12, Blade, and Bootstrap 5. Features a dark mode design, reusable Blade components, and user management capabilities.

## Deskripsi Website Event Organizer

Website ini merupakan platform company profile untuk **Event Organizer** yang membantu memperkenalkan layanan, pengalaman, portofolio, dan kredibilitas perusahaan kepada calon klien. Website dirancang sebagai media informasi sekaligus sarana konsultasi bagi instansi, sekolah, perusahaan, komunitas, maupun masyarakat yang membutuhkan jasa penyelenggaraan acara.

Pengunjung dapat melihat informasi lengkap mengenai profil perusahaan, berbagai layanan yang tersedia, dokumentasi kerja sama, testimoni klien, serta informasi kontak. Calon klien juga dapat berkonsultasi langsung melalui WhatsApp dengan pesan yang telah disiapkan.

Website dilengkapi halaman admin untuk mengelola konten secara mandiri tanpa perlu mengubah kode program. Admin dapat memperbarui layanan, portofolio kerja sama, testimoni, profil perusahaan, informasi kontak, dan media sosial.

## Fitur-Fitur Unggulan

### 1. Beranda Informatif

Menampilkan headline, deskripsi layanan, tombol konsultasi WhatsApp, layanan unggulan, cuplikan portofolio, testimoni klien, dan informasi kontak.

### 2. Informasi Layanan Lengkap

Menyediakan kategori layanan **Pelatihan**, **Workshop**, **Seminar**, dan **Penyewaan**. Setiap layanan memiliki halaman detail berisi deskripsi, foto, fasilitas, serta informasi kebutuhan klien.

### 3. Fitur Penyewaan Peralatan

Pengunjung dapat melihat peralatan atau fasilitas yang disewakan, seperti sound system, tenda, venue, dan perlengkapan pendukung acara lainnya. Setiap item dapat dilengkapi foto serta deskripsi.

### 4. Konsultasi Langsung melalui WhatsApp

Tombol WhatsApp tersedia pada halaman website untuk memudahkan calon klien menghubungi Event Organizer. Pesan konsultasi dapat dibuat otomatis berdasarkan layanan yang dipilih.

### 5. Portofolio Kerja Sama

Menampilkan rekam jejak kerja sama dengan berbagai mitra atau klien, lengkap dengan nama mitra, nama kegiatan, tanggal kegiatan, deskripsi acara, dan galeri foto dokumentasi.

### 6. Testimoni Klien

Menampilkan pengalaman klien berupa nama, instansi atau jabatan, foto, komentar, dan rating jika tersedia. Testimoni dapat ditampilkan pada beranda maupun halaman khusus.

### 7. Halaman Tentang Kami

Berisi profil perusahaan, visi dan misi, nilai serta keunggulan perusahaan, informasi tim, dan pengalaman dalam menangani kegiatan.

### 8. Informasi Kontak dan Lokasi

Menyediakan alamat perusahaan, nomor telepon dan WhatsApp, email, jam operasional, peta lokasi, serta tautan media sosial.

### 9. Dashboard Admin

Admin dapat mengelola layanan, portofolio kerja sama, testimoni, profil perusahaan, kontak, media sosial, dan akun pengguna melalui dashboard khusus.

### 10. Manajemen Konten Tanpa Mengubah Kode

Admin dapat menambah, mengubah, menghapus, serta mengatur status tampil atau sembunyi pada konten website secara langsung melalui dashboard.

### 11. Desain Responsif

Website dapat digunakan dengan nyaman melalui smartphone, tablet, laptop, maupun komputer desktop. Tampilan menyesuaikan ukuran layar agar informasi tetap mudah dibaca.

### 12. Galeri Dokumentasi Kegiatan

Setiap proyek atau kerja sama dapat memiliki beberapa foto dokumentasi untuk menampilkan hasil kegiatan secara lebih menarik dan meyakinkan.

## Kesimpulan

Website Event Organizer ini menjadi media digital terpadu untuk memperkenalkan layanan, membangun kepercayaan, menampilkan pengalaman kerja, dan menerima konsultasi dari calon klien. Dengan dukungan halaman publik yang informatif serta dashboard admin yang mudah digunakan, pengelolaan dan pembaruan informasi dapat dilakukan dengan cepat, praktis, dan terstruktur.

## ✨ Features

- 🎨 **Modern UI** - Beautiful, modern theme with glassmorphism effects
- ⚡ **Blade + Controllers** - Server-rendered pages with clean Laravel controllers
- 🔐 **Authentication** - Login and registration with server-side validation
- 👥 **User Management** - Full CRUD operations for managing users
- 🧩 **Reusable Components** - Extensive library of Blade components for rapid development
- 📱 **Responsive Design** - Fully responsive layout that works on all devices
- 🎯 **Component Library** - Pre-built UI components including:
  - Buttons, Inputs, Badges, Alerts
  - Tables with pagination
  - Modals, Cards, and Progress Bars
  - Sidebar navigation with sections
  - Topbar with user menu

## 🚀 Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade, Bootstrap 5, Alpine.js
- **Build Tool**: Vite 7.x
- **Testing**: Pest PHP

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL/PostgreSQL/SQLite

## 🛠️ Installation

### Quick Setup

Run the automated setup script:

```bash
composer setup
```

This will:
- Install PHP dependencies
- Create `.env` file from `.env.example`
- Generate application key
- Run database migrations
- Create the public storage link for uploaded files
- Install npm dependencies
- Build frontend assets

### Manual Setup

If you prefer to set up manually:

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd minimal-gravity-admin
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**

   Update your `.env` file with database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Create the public storage link**
   ```bash
   php artisan storage:link
   ```

7. **Install npm dependencies and build assets**
   ```bash
   npm install
   npm run build
   ```

## 🏃 Running the Application

> Make sure `APP_URL` in `.env` matches the URL you visit (for example `http://localhost:8000`). Uploaded avatars use this value when generating their public URLs.

### Development Mode

The easiest way to run the application in development mode:

```bash
composer dev
```

This command starts:
- Laravel development server (http://localhost:8000)
- Queue worker
- Laravel Pail (logs)
- Vite dev server (hot module replacement)

All services run concurrently with color-coded output.

### Access from Other Devices (LAN)

To make the development server reachable from a phone or another computer:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Set `APP_URL` in `.env` to the host machine's LAN address, for example:

```env
APP_URL=http://192.168.1.31:8000
```

Then open `http://192.168.1.31:8000` from the other device. Make sure your firewall allows port `8000`.

### Individual Services

Alternatively, run services separately:

```bash
# Terminal 1 - Laravel server
php artisan serve

# Terminal 2 - Vite dev server
npm run dev

# Terminal 3 (optional) - Queue worker
php artisan queue:listen

# Terminal 4 (optional) - Logs
php artisan pail
```

## 📁 Project Structure

```
├── app/
│   └── Http/Controllers/
│       ├── Admin/                 # Dashboard, users, profile, component docs
│       ├── Auth/                  # Login and registration
│       └── Guest/                 # Public landing page
├── resources/
│   └── views/
│       ├── admin/                 # Admin pages and partials
│       ├── auth/                  # Login and register pages
│       ├── guest/                 # Public pages
│       └── components/
│           ├── form/              # Form components
│           ├── layout/            # Page layout components
│           ├── layouts/           # App and guest layout wrappers
│           └── ui/                # UI components
├── routes/
│   └── web.php                    # Web routes
└── database/
    └── migrations/                # Database migrations
```

## 🎨 Available Components

### Layout Components

Located in `resources/views/components/layout/`:

- `sidebar.blade.php` - Sidebar navigation
- `topbar.blade.php` - Top navigation bar
- `sidebar-link.blade.php` - Sidebar navigation links
- `sidebar-section.blade.php` - Sidebar section headers
- `page-header.blade.php` - Page header sections
- `modern-card.blade.php` - Modern styled cards
- `feature-card.blade.php` - Feature display cards
- `stat-card.blade.php` - Statistics cards
- `table-card.blade.php` - Table wrapper cards
- `table.blade.php` - Data tables
- `modal.blade.php` / `modal-form.blade.php` - Modal wrappers

### UI Components

Located in `resources/views/components/ui/`:

- `button.blade.php` - Reusable button component
- `input.blade.php` - Form input component
- `badge.blade.php` - Status badges
- `alert.blade.php` - Alert messages
- `confirm-modal.blade.php` - Confirmation dialogs
- `progress-bar.blade.php` - Progress indicators

### Layout Wrappers

- `resources/views/components/layouts/app.blade.php` - Authenticated admin layout
- `resources/views/components/layouts/guest.blade.php` - Public/auth layout

## 🔑 Authentication

The application includes a modern login and registration system:

- **Routes**: `/login`, `/register`
- **Controllers**: `App\Http\Controllers\Auth\LoginController`, `App\Http\Controllers\Auth\RegisterController`
- **Views**: `resources/views/auth/login.blade.php`, `resources/views/auth/register.blade.php`

Protected admin routes require authentication middleware.

## 👥 User Management

Full CRUD interface for managing users:

- **Route**: `/admin/users`
- **Controller**: `App\Http\Controllers\Admin\UserController`
- **Features**:
  - Create new users
  - Edit existing users
  - Delete users
  - Search and filter
  - Pagination

## 👤 Profile Management

Users can manage their own account:

- **Route**: `/admin/profile`
- **Controller**: `App\Http\Controllers\Admin\ProfileController`
- **Features**:
  - Update name and email
  - Upload or remove an avatar
  - Change password

## 🧪 Testing

Run the test suite:

```bash
composer test
# or
php artisan test
```

## 🎯 Usage Examples

### Creating a New Admin Page

1. Create a controller:
   ```bash
   php artisan make:controller Admin/YourPageController
   ```

2. Add a route in `routes/web.php`:
   ```php
   Route::get('/admin/your-page', [YourPageController::class, 'index'])
       ->name('admin.your-page')
       ->middleware('auth');
   ```

3. Wrap your view with the admin layout:
   ```blade
   <x-layouts.app title="Your Page Title">
       <x-layout.page-header title="Your Page Title" subtitle="Page description" />

       <x-layout.modern-card>
           {{-- Your content --}}
       </x-layout.modern-card>
   </x-layouts.app>
   ```

### Using Component Examples

**Button Component:**
```blade
<x-ui.button variant="primary" size="md">
    Save Changes
</x-ui.button>
```

**Input Component:**
```blade
<x-form.input
    label="Email"
    type="email"
    name="email"
    required
/>
```

**Alert Component:**
```blade
<x-ui.alert variant="success">
    Operation completed successfully!
</x-ui.alert>
```

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License.

## 🆘 Support

For issues, questions, or contributions, please open an issue on GitHub.

---

**Built with ❤️ using Laravel and Bootstrap**
