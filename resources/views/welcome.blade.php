<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zidan Store - Produk digital </title>
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

            /* Dark Mode Colors */
            --dark-bg: #0f172a;
            --dark-card-bg: #1e293b;
            --dark-text-color: #f1f5f9;
            --dark-nav-bg: rgba(15, 23, 42, 0.8);
            --dark-nav-border: rgba(255, 255, 255, 0.1);
            --dark-text-muted: #cbd5e1;
            --dark-card-alt-bg: #334155;
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

        [data-theme="light"] .why-us-card { background: #f8fafc; }
        [data-theme="dark"] .why-us-card { background: #1e293b; }

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

        /* === HERO SECTION === */
        .hero-gradient {
            background: linear-gradient(270deg, #0F0C29, #302B63, #24243E);
            background-size: 600% 600%;
            animation: gradientAnimator 16s ease infinite;
            position: relative;
        }
        .hero-gradient::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background:
                radial-gradient(circle at 15% 30%, rgba(120, 119, 198, 0.4) 0%, transparent 40%),
                radial-gradient(circle at 85% 70%, rgba(139, 92, 246, 0.4) 0%, transparent 40%);
            animation: lightsAnimator 12s ease-in-out infinite;
        }

        @keyframes gradientAnimator {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        @keyframes lightsAnimator {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.1); }
        }

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
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* === PRODUCT CARD === */
        .product-card {
            border-radius: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
        }
        [data-theme="dark"] .product-card { box-shadow: 0 8px 30px rgba(255, 255, 255, 0.05); }

        .product-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        [data-theme="dark"] .product-card:hover { box-shadow: 0 20px 40px rgba(255, 255, 255, 0.1); }

        .product-card .product-image img {
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        /* === NEWSLETTER === */
        .newsletter-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* === TEXT & OTHER === */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary-color-start), var(--primary-color-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-bg {
            background-color: #111827;
        }

        @keyframes pulse-slow {
            0%, 100% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.1); opacity: 0.5; }
        }
        .animate-pulse-slow { animation: pulse-slow 1s ease-in-out infinite; }
        .delay-1000 { animation-delay: 1s; }
        .delay-2000 { animation-delay: 2s; }

        /* General font and body settings */
        * { font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        body { overflow-x: hidden; }

        .text-slate-600, .text-slate-500, .text-slate-800, .text-gray-900, .text-gray-600 {
            transition: color 0.3s ease;
        }
        [data-theme="dark"] .text-slate-600,
        [data-theme="dark"] .text-slate-500,
        [data-theme="dark"] .text-gray-600 {
            color: var(--dark-text-muted) !important;
        }
        [data-theme="dark"] .text-slate-900,
        [data-theme="dark"] .text-gray-900 {
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
                    <a href="#" class="text-slate-600 hover:text-slate-900 font-medium text-sm transition-colors animated-element slide-down delay-100">Home</a>
                    <a href="#" class="text-slate-600 hover:text-slate-900 font-medium text-sm transition-colors animated-element slide-down delay-200">Categories</a>
                    <a href="#" class="text-slate-600 hover:text-slate-900 font-medium text-sm transition-colors animated-element slide-down delay-300">Collections</a>
                    <a href="#" class="text-slate-600 hover:text-slate-900 font-medium text-sm transition-colors animated-element slide-down delay-400">About</a>
                </div>
                <div class="flex items-center space-x-5">
                    <button class="text-slate-500 hover:text-slate-800 transition-colors animated-element slide-down delay-500"><i class="fas fa-search text-lg"></i></button>
                    <button id="themeToggle" class="text-slate-500 hover:text-slate-800 transition-colors animated-element slide-down delay-600">
                        <i class="fas fa-moon text-lg" id="themeIcon"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <section class="relative hero-gradient pt-44 pb-28 lg:pt-35 lg:pb-40 overflow-hidden">
            <div class="absolute inset-0 -z-10 overflow-hidden">
                <div class="absolute top-[-200px] left-[-200px] w-[400px] h-[400px] bg-purple-500 opacity-30 rounded-full filter blur-3xl animate-pulse-slow"></div>
                <div class="absolute bottom-[-80px] right-[-80px] w-[250px] h-[250px] bg-indigo-400 opacity-30 rounded-full filter blur-2xl animate-pulse-slow delay-2000"></div>
                <div class="absolute top-[40%] left-[45%] w-[300px] h-[200px] bg-blue-500 opacity-20 rounded-full filter blur-2xl animate-pulse-slow delay-1000"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight md:leading-[1.2] mb-6 sm:mb-8 tracking-tight max-w-4xl mx-auto animated-element slide-up">
                    Mulai Belanja
                    <span class="block bg-clip-text text-transparent bg-gradient-to-r from-slate-100 to-slate-400">
                        Sekarang Juga!
                    </span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-white/80 mb-10 sm:mb-12 max-w-2xl mx-auto leading-relaxed animated-element slide-up delay-100">
                    Menjual produk digital terlengkap, cepat, dan terpercaya. Solusi instan untuk semua kebutuhan digitalmu!
                </p>
                <div class="flex flex-wrap justify-center gap-3 sm:gap-5 animated-element slide-up delay-200">
                    <button class="btn-primary text-white font-semibold px-6 py-2 sm:px-8 sm:py-3 rounded-full text-sm sm:text-base min-w-[140px] sm:min-w-[180px] hover:scale-105 transition-transform duration-300">
                        Beli Sekarang
                    </button>
                    <button class="btn-secondary text-white font-semibold px-6 py-2 sm:px-8 sm:py-3 rounded-full text-sm sm:text-base min-w-[140px] sm:min-w-[180px] hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-headset mr-2"></i> Support
                    </button>
                </div>
            </div>
        </section>

        <section class="py-12 sm:py-20 bg-light-card-alt-bg dark:bg-dark-card-alt-bg transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10 sm:mb-12">
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Mengapa Memilih Kami?
                    </h2>
                    <p class="mt-3 sm:mt-4 max-w-2xl mx-auto text-base sm:text-lg text-slate-600">
                        Kami memberikan nilai lebih pada setiap produk digital yang Anda beli.
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

        <section class="py-12 sm:py-16 lg:py-20 bg-light-bg dark:bg-dark-bg transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10 sm:mb-12 lg:mb-16">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">
                        List Product
                    </h2>
                    <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">
                        Produk digital kami.
                    </p>
                </div>
                @if (session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-xl mb-10 flex items-center shadow-sm">
                        <i class="fas fa-check-circle mr-3 text-emerald-600"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                <div class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 lg:gap-x-8 lg:gap-y-12">
                    @foreach($produks as $produk)
                        <div class="group relative product-card rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
                            <a href="{{ route('beli.produk', $produk->id) }}" class="block">
                                <div class="w-full h-48 sm:h-56 lg:h-72 rounded-t-xl overflow-hidden">
                                    @if ($produk->gambar)
                                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                            <i class="fas fa-image text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            <div class="p-4 sm:p-5 flex-1 flex flex-col">
                                <a href="{{ route('beli.produk', $produk->id) }}" class="block">
                                    <h3 class="mt-1 text-sm sm:text-base font-semibold text-gray-900 truncate">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $produk->nama }}
                                    </h3>
                                </a>
                                <p class="mt-1 text-xs sm:text-sm text-gray-500 h-10 line-clamp-2">{{ $produk->deskripsi }}</p>
                                <div class="mt-3 flex items-center justify-between">
                                    <p class="text-base sm:text-lg font-bold text-indigo-600">Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                                    <a href="{{ route('beli.produk', $produk->id) }}" class="flex items-center justify-center p-2 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                        <i class="fas fa-plus w-4 h-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="py-20 bg-light-bg dark:bg-dark-bg transition-colors duration-300">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="newsletter-bg rounded-3xl p-10 md:p-16 text-center relative overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="text-3xl md:text-4xl font-black text-white mb-4 animated-element slide-up">Ingin dapet info produk baru di Zidan Store ?</h2>
                        <p class="text-lg text-white/80 mb-8 max-w-xl mx-auto animated-element slide-up delay-100">
                            Mendapatkan notif jika ada produk baruu.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto animated-element slide-up delay-200">
                            <input type="email" placeholder="Enter your email" class="flex-1 px-6 py-4 rounded-full border-0 bg-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/80 transition">
                            <button class="btn-secondary text-slate-400 font-bold px-8 py-4 rounded-full whitespace-nowrap bg-white/90 text-slate-800 hover:bg-white">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer-bg text-slate-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="lg:col-span-2">
                    <h3 class="text-2xl font-bold text-white mb-4">Zidan Store</h3>
                    <p class="text-slate-400 mb-6 max-w-md">website pilihan bagus buat beli produk digital anda.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-indigo-500 transition-colors"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-indigo-500 transition-colors"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-indigo-500 transition-colors"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Products</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Customer Service</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Shipping Info</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-slate-400 text-sm">&copy; 2025 Zidan Store. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-slate-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                    <a href="#" class="text-slate-400 hover:text-white text-sm transition-colors">Terms of Service</a>
                </div>
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