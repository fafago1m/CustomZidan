<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beli Produk - Zidan Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --primary-color-start: #6366f1;
            --primary-color-end: #8b5cf6;

            /* Light Mode Colors */
            --light-bg: #f8fafc;
            --light-card-bg: #ffffff;
            --light-text-color: #0f172a;
            --light-nav-bg: rgba(255, 255, 255, 0.7);
            --light-nav-border: rgba(255, 255, 255, 0.2);
            --light-text-muted: #64748b;
            --light-card-alt-bg: #f1f5f9;
            --light-form-bg: rgba(255, 255, 255, 0.9);
            --light-form-border: rgba(0, 0, 0, 0.1);
            --light-footer-bg: #111827;
            --light-footer-text: #d1d5db;

            /* Dark Mode Colors */
            --dark-bg: #0f172a;
            --dark-card-bg: #1e293b;
            --dark-text-color: #f1f5f9;
            --dark-nav-bg: rgba(15, 23, 42, 0.8);
            --dark-nav-border: rgba(255, 255, 255, 0.1);
            --dark-text-muted: #cbd5e1;
            --dark-card-alt-bg: #334155;
            --dark-form-bg: rgba(30, 41, 59, 0.9);
            --dark-form-border: rgba(255, 255, 255, 0.1);
            --dark-footer-bg: #111827;
            --dark-footer-text: #6b7280;
        }

        [data-theme="light"] body { background-color: var(--light-bg); color: var(--light-text-color); }
        [data-theme="dark"] body { background-color: var(--dark-bg); color: var(--dark-text-color); }

        [data-theme="light"] .nav-glass {
            background: var(--light-nav-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--light-nav-border);
        }
        [data-theme="dark"] .nav-glass {
            background: var(--dark-nav-bg);
            border-bottom: 1px solid var(--dark-nav-border);
        }

        [data-theme="light"] .product-card { background: var(--light-card-bg); }
        [data-theme="dark"] .product-card { background: var(--dark-card-bg); }

        [data-theme="light"] .why-us-card { background: var(--light-card-alt-bg); }
        [data-theme="dark"] .why-us-card { background: var(--dark-card-bg); }

        [data-theme="light"] .form-input {
            background: var(--light-form-bg);
            border: 1px solid var(--light-form-border);
            color: var(--light-text-color);
        }
        [data-theme="dark"] .form-input {
            background: var(--dark-form-bg);
            border: 1px solid var(--dark-form-border);
            color: var(--dark-text-color);
        }
        .form-input:focus {
            border-color: var(--primary-color-start);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        [data-theme="light"] .bg-gray-100 { background-color: #f3f4f6; }
        [data-theme="dark"] .bg-gray-100 { background-color: #1f2937; }

        /* === ANIMATIONS & EFFECTS === */
        .animated-element {
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .slide-up { transform: translateY(50px); }
        .slide-down { transform: translateY(-50px); }
        .slide-left { transform: translateX(50px); }
        .slide-right { transform: translateX(-50px); }
        .scale-in { transform: scale(0.9); }

        .animated-element.is-visible {
            opacity: 1;
            transform: none;
        }

        .delay-100 { transition-delay: 0.1s; }
        .delay-200 { transition-delay: 0.2s; }
        .delay-300 { transition-delay: 0.3s; }
        .delay-400 { transition-delay: 0.4s; }
        .delay-500 { transition-delay: 0.5s; }
        .delay-600 { transition-delay: 0.6s; }
        .delay-700 { transition-delay: 0.7s; }

        /* === BUTTONS === */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color-start) 0%, var(--primary-color-end) 100%);
            box-shadow: 0 4px 15px -5px rgba(99, 102, 241, 0.5);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-primary:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 10px 25px -8px rgba(99, 102, 241, 0.6);
        }
        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        [data-theme="light"] .btn-secondary {
            background: var(--light-card-bg);
            border-color: #d1d5db;
            color: #4b5563;
        }
        [data-theme="dark"] .btn-secondary {
            background: var(--dark-card-bg);
            border-color: #4b5563;
            color: var(--dark-text-color);
        }
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* === TEXT & OTHER === */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary-color-start), var(--primary-color-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .product-badge {
            background: linear-gradient(135deg, var(--primary-color-start), var(--primary-color-end));
        }

        /* === FOOTER === */
        .footer-bg {
            background-color: var(--light-footer-bg);
            color: var(--light-footer-text);
        }
        [data-theme="dark"] .footer-bg {
            background-color: var(--dark-bg);
            color: var(--dark-text-muted);
        }

        /* === GENERAL THEME SWITCHING === */
        .text-slate-600, .text-slate-500, .text-slate-800, .text-gray-900, .text-gray-600, .text-gray-700, .text-gray-500 {
            transition: color 0.3s ease;
        }
        [data-theme="dark"] .text-slate-600,
        [data-theme="dark"] .text-slate-500,
        [data-theme="dark"] .text-gray-600,
        [data-theme="dark"] .text-gray-500 {
            color: var(--dark-text-muted) !important;
        }
        [data-theme="dark"] .text-slate-900,
        [data-theme="dark"] .text-gray-900,
        [data-theme="dark"] .text-gray-700 {
            color: var(--dark-text-color) !important;
        }

    </style>
</head>

<body class="antialiased" data-theme="light">

    <nav class="nav-glass fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center animated-element slide-down">
                    <h1 class="text-3xl font-black text-gradient tracking-tight">Zidan Store</h1>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-slate-600 hover:text-slate-900 font-medium text-sm transition-colors animated-element slide-down delay-100">Home</a>
                    <a href="#" class="text-slate-600 hover:text-slate-900 font-medium text-sm transition-colors animated-element slide-down delay-200">Categories</a>
                    <a href="#" class="text-slate-600 hover:text-slate-900 font-medium text-sm transition-colors animated-element slide-down delay-300">Collections</a>
                    <a href="#" class="text-slate-600 hover:text-slate-900 font-medium text-sm transition-colors animated-element slide-down delay-400">About</a>
                </div>
                <div class="flex items-center space-x-5">
                    <button class="text-slate-500 hover:text-slate-800 transition-colors animated-element slide-down delay-500"><i class="fas fa-search text-lg"></i></button>
                    <button id="themeToggle" class="text-slate-500 hover:text-slate-800 transition-colors animated-element slide-down delay-600">
                        <i class="fas fa-moon text-lg" id="themeIcon"></i>
                    </button>
                    <button class="text-slate-500 hover:text-slate-800 transition-colors relative animated-element slide-down delay-700">
                        <i class="fas fa-heart text-lg"></i>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">2</span>
                    </button>
                    <button class="text-slate-500 hover:text-slate-800 transition-colors relative animated-element slide-down delay-700">
                        <i class="fas fa-shopping-bag text-lg"></i>
                        <span class="absolute -top-2 -right-2 bg-indigo-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">3</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-28">
        <section class="bg-light-bg dark:bg-dark-bg py-12 transition-colors duration-300">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="product-card rounded-3xl shadow-xl overflow-hidden">
                    <div class="md:flex">
                        <div class="md:w-2/5 bg-gray-100 p-8 flex items-center justify-center">
                            @if ($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}" class="w-full h-auto max-h-96 object-contain rounded-lg">
                            @else
                                <div class="w-full h-64 flex items-center justify-center bg-gray-200 text-gray-400 rounded-lg">
                                    <i class="fas fa-image text-6xl"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="md:w-3/5 p-8">
                            <div class="flex items-center mb-4">
                                <span class="product-badge text-white text-xs font-bold px-3 py-1 rounded-full mr-3">BARU</span>
                                <span class="text-sm text-gray-500">Produk Digital</span>
                            </div>
                            
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $produk->nama }}</h2>
                            <p class="text-lg font-semibold text-indigo-600 mb-6">Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                            
                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-900 mb-2">Deskripsi Produk</h3>
                                <p class="text-gray-600">{{ $produk->deskripsi }}</p>
                            </div>
                            
                            <form method="POST" action="{{ route('beli.submit') }}" class="space-y-6">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" required 
                                            class="form-input w-full px-4 py-3 rounded-lg border focus:ring-2 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email (opsional)</label>
                                    <input type="email" id="email" name="email" 
                                            class="form-input w-full px-4 py-3 rounded-lg border focus:ring-2 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
                                    <input type="text" id="no_wa" name="no_wa" required 
                                            class="form-input w-full px-4 py-3 rounded-lg border focus:ring-2 focus:ring-indigo-500">
                                    <p class="mt-1 text-sm text-gray-500">Kami akan mengirim detail pembelian melalui WhatsApp</p>
                                </div>

                                <div class="flex items-center space-x-4">
                                    <button type="submit" class="btn-primary text-white font-semibold px-6 py-3 rounded-lg w-full text-center">
                                        Beli Sekarang
                                    </button>
                                    <a href="{{ route('home') }}" class="btn-secondary font-semibold px-6 py-3 rounded-lg w-full text-center">
                                        Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 bg-light-card-alt-bg dark:bg-dark-card-alt-bg transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-4">
                        Mengapa Belanja di Zidan Store?
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Kami memberikan pengalaman belanja digital yang aman, cepat, dan terpercaya.
                    </p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="why-us-card text-center p-4 sm:p-6 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-sky-500 to-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-5 sm:mb-6 shadow-lg shadow-blue-500/30">
                            <i class="fas fa-cloud-arrow-down text-white text-2xl sm:text-3xl"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-2">Akses Instan</h3>
                        <p class="text-sm sm:text-base text-slate-600">Unduh & gunakan produk langsung setelah pembayaran berhasil.</p>
                    </div>
                    <div class="why-us-card text-center p-4 sm:p-6 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-emerald-500 to-green-600 rounded-3xl flex items-center justify-center mx-auto mb-5 sm:mb-6 shadow-lg shadow-green-500/30">
                            <i class="fas fa-arrows-rotate text-white text-2xl sm:text-3xl"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-2">Update Gratis</h3>
                        <p class="text-sm sm:text-base text-slate-600">Nikmati semua pembaruan fitur dan perbaikan selamanya, tanpa biaya.</p>
                    </div>
                    <div class="why-us-card text-center p-4 sm:p-6 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center mx-auto mb-5 sm:mb-6 shadow-lg shadow-purple-500/30">
                            <i class="fas fa-shield-halved text-white text-2xl sm:text-3xl"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-2">Transaksi Aman</h3>
                        <p class="text-sm sm:text-base text-slate-600">Pembayaran Anda dilindungi dengan teknologi enkripsi terdepan.</p>
                    </div>
                    <div class="why-us-card text-center p-4 sm:p-6 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-rose-500 to-pink-600 rounded-3xl flex items-center justify-center mx-auto mb-5 sm:mb-6 shadow-lg shadow-rose-500/30">
                            <i class="fas fa-headset text-white text-2xl sm:text-3xl"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-2">Dukungan Penuh</h3>
                        <p class="text-sm sm:text-base text-slate-600">Tim kami selalu siap sedia untuk membantu setiap kendala Anda.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer-bg text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">Zidan Store</h3>
                    <p class="mb-4">Toko digital terpercaya untuk semua kebutuhan produk digital Anda.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white">Beranda</a></li>
                        <li><a href="#" class="hover:text-white">Produk</a></li>
                        <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Bantuan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Cara Belanja</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
                &copy; 2023 Zidan Store. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const html = document.documentElement;
            const themeToggle = document.getElementById("themeToggle");
            const themeIcon = document.getElementById("themeIcon");

            // Function to set the theme
            function setTheme(theme) {
                html.setAttribute('data-theme', theme);
                localStorage.setItem("theme", theme);
                updateThemeIcon(theme);
            }

            // Function to update the theme icon
            function updateThemeIcon(theme) {
                if (theme === "dark") {
                    themeIcon.classList.remove("fa-moon");
                    themeIcon.classList.add("fa-sun");
                } else {
                    themeIcon.classList.remove("fa-sun");
                    themeIcon.classList.add("fa-moon");
                }
            }

            // Check for user's preferred theme or saved theme on load
            const savedTheme = localStorage.getItem("theme");
            const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme) {
                setTheme(savedTheme);
            } else if (prefersDark) {
                setTheme('dark');
            } else {
                setTheme('light');
            }

            // Event listener for the theme toggle button
            themeToggle.addEventListener("click", () => {
                const currentTheme = html.getAttribute('data-theme');
                setTheme(currentTheme === "dark" ? "light" : "dark");
            });

            // Intersection Observer for scroll animations
            const animatedElements = document.querySelectorAll('.animated-element');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            animatedElements.forEach(el => {
                if (el.getBoundingClientRect().top < window.innerHeight) {
                    el.classList.add('is-visible');
                    observer.unobserve(el);
                } else {
                    observer.observe(el);
                }
            });

            // Dynamic navbar background on scroll
            const navbar = document.querySelector('nav');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('shadow-md');
                } else {
                    navbar.classList.remove('shadow-md');
                }
            });
        });
    </script>
</body>
</html>