<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice #{{ $transaksi->id }} - Zidan Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --primary-color-start: #6366f1;
            --primary-color-end: #8b5cf6;
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
            --light-border-color: #e5e7eb;
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
            --dark-border-color: #374151;
        }

        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            min-height: 100vh;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        [data-theme="light"] body {
            background: linear-gradient(135deg, var(--light-card-alt-bg) 0%, #e4ecf7 100%);
            color: var(--light-text-color);
        }
        [data-theme="dark"] body {
            background-color: var(--dark-bg);
            color: var(--dark-text-color);
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--primary-color-start), var(--primary-color-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .invoice-card {
            border-radius: 1.5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        [data-theme="light"] .invoice-card { background-color: var(--light-card-bg); }
        [data-theme="dark"] .invoice-card { background-color: var(--dark-card-bg); }

        .invoice-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }

        .qr-img {
            max-width: 220px;
            border-radius: 1rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        [data-theme="dark"] .qr-img { filter: invert(0.9); }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color-start) 0%, var(--primary-color-end) 100%);
            box-shadow: 0 4px 15px -5px rgba(99, 102, 241, 0.5);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-primary:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 10px 25px -8px rgba(99, 102, 241, 0.6);
        }
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 4px 15px -5px rgba(16, 185, 129, 0.5);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-success:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 10px 25px -8px rgba(16, 185, 129, 0.6);
        }

        .info-card {
            border-left: 4px solid var(--primary-color-start);
        }
        [data-theme="light"] .info-card {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
        }
        [data-theme="dark"] .info-card {
            background: rgba(99, 102, 241, 0.1);
            border-left: 4px solid #6366f1;
        }

        .error-card {
            border-left: 4px solid #ef4444;
        }
        [data-theme="light"] .error-card {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(220, 38, 38, 0.05) 100%);
        }
        [data-theme="dark"] .error-card {
            background: rgba(239, 68, 68, 0.1);
            border-left: 4px solid #ef4444;
        }

        .text-gray-900, .text-gray-600, .text-gray-500 {
            transition: color 0.3s ease;
        }
        [data-theme="dark"] .text-gray-900 {
            color: var(--dark-text-color) !important;
        }
        [data-theme="dark"] .text-gray-600,
        [data-theme="dark"] .text-gray-500 {
            color: var(--dark-text-muted) !important;
        }
        [data-theme="dark"] .border-gray-200 { border-color: var(--dark-border-color) !important; }
        [data-theme="dark"] .bg-white { background-color: var(--dark-card-bg) !important; }

        .nav-glass {
            transition: all 0.3s ease;
        }
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
    </style>
</head>

<body class="antialiased py-10" data-theme="light">
    <nav class="nav-glass fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <h1 class="text-3xl font-black text-gradient tracking-tight">Zidan Store</h1>
                </div>
                <div class="flex items-center space-x-5">
                    <button id="themeToggle" class="text-gray-500 hover:text-gray-800 transition-colors">
                        <i class="fas fa-moon text-lg" id="themeIcon"></i>
                    </button>
                    <a href="{{ route('home') }}" class="btn-secondary font-semibold px-4 py-2 rounded-lg text-sm">
                        <i class="fas fa-home mr-2"></i> 
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">
        <div class="bg-white p-8 sm:p-10 invoice-card">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900">
                        <span class="text-gradient">Zidan Store</span> Invoice
                    </h1>
                    <p class="text-gray-500 mt-1">#{{ $transaksi->id }}</p>
                </div>
                <div class="text-right">
                    @if ($transaksi->status === 'pending')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800" id="statusPayment">
                            <i class="fas fa-clock mr-1.5"></i> Pending
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800" id="statusPayment">
                            <i class="fas fa-check-circle mr-1.5"></i> Paid
                        </span>
                    @endif
                </div>
            </div>

            <div class="border-t border-gray-200 my-6"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-user text-indigo-500 mr-2"></i> Customer Details
                    </h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-user-circle text-gray-400 mt-1 mr-2 w-4"></i>
                            <span>{{ $transaksi->nama }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fab fa-whatsapp text-gray-400 mt-1 mr-2 w-4"></i>
                            <span>{{ $transaksi->no_wa }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="far fa-calendar-alt text-gray-400 mt-1 mr-2 w-4"></i>
                            <span>{{ $transaksi->created_at->format('d M Y, H:i') }}</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-box-open text-indigo-500 mr-2"></i> Product Details
                    </h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-tag text-gray-400 mt-1 mr-2 w-4"></i>
                            <span>{{ $transaksi->produk->nama }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-money-bill-wave text-gray-400 mt-1 mr-2 w-4"></i>
                            <span>Rp {{ number_format($transaksi->produk->harga, 0, ',', '.') }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-info-circle text-gray-400 mt-1 mr-2 w-4"></i>
                            <span>Digital Product</span>
                        </li>
                    </ul>
                </div>
            </div>

            @if ($payment && !isset($payment['error']))
                <div class="info-card rounded-lg p-5 mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-emerald-500 text-2xl mt-1"></i>
                        </div>
                        <div class="ml-4 w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Payment Instructions</h3>
                            <p class="text-gray-600 mb-4">Scan QR code below or use the payment code to complete your transaction.</p>
                            
                            @if (isset($payment['data']['qrImageUrl']))
                                <div class="flex flex-col sm:flex-row items-center gap-6">
                                    <img src="{{ $payment['data']['qrImageUrl'] }}" alt="QRIS Payment" class="qr-img">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Total Amount</p>
                                        <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($transaksi->amount, 0, ',', '.') }}</p>
                                        <div class="mt-2 flex items-center text-gray-500">
                                            <i class="fas fa-hourglass-half mr-2"></i>
                                            <p class="text-sm">Expires in: <span id="countdown" class="font-semibold"></span></p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @elseif ($payment && isset($payment['error']))
                <div class="error-card rounded-lg p-5 mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-500 text-2xl mt-1"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Payment Error</h3>
                            <p class="text-gray-600">{{ $payment['error'] }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="mt-10">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-key text-indigo-500 mr-2"></i> Product Access
                </h3>

                @if ($transaksi->status === 'paid')
                    <div class="space-y-4">
                        @if ($transaksi->produk->link)
                            <a href="{{ $transaksi->produk->link }}" target="_blank" 
                                class="btn-success text-white font-medium py-3 px-6 rounded-lg inline-flex items-center transition-all">
                                <i class="fas fa-external-link-alt mr-2"></i> Access Product Link
                            </a>
                        @endif

                        @if ($transaksi->produk->file_path)
                            <a href="{{ asset('storage/' . $transaksi->produk->file_path) }}" download
                                class="btn-primary text-white font-medium py-3 px-6 rounded-lg inline-flex items-center transition-all">
                                <i class="fas fa-download mr-2"></i> Download Product File
                            </a>
                        @endif

                        @if (!$transaksi->produk->file_path && !$transaksi->produk->link)
                            <div class="bg-amber-50 border-l-4 border-amber-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-amber-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-amber-700">
                                            No download link or access URL available for this product. Please contact support.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="bg-amber-50 border-l-4 border-amber-400 p-4" id="pendingMessage">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-clock text-amber-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-amber-700">
                                    Your payment is still being processed. Product access will be available after payment confirmation.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('mutasi.manual', ['id' => $transaksi->id]) }}" class="mt-4" id="checkPaymentForm">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-sync-alt mr-2"></i> Check Payment Status
                        </button>
                    </form>
                @endif
            </div>

            <div class="border-t border-gray-200 mt-10 pt-6 text-sm text-gray-500">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p>Need help? <a href="#" class="text-indigo-600 hover:text-indigo-800">Contact our support</a></p>
                    <p class="mt-2 md:mt-0">© {{ date('Y') }} Zidan Store. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

     <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Theme toggle logic (unchanged)
            const html = document.documentElement;
            const themeToggle = document.getElementById("themeToggle");
            const themeIcon = document.getElementById("themeIcon");

            function setTheme(theme) {
                html.setAttribute('data-theme', theme);
                localStorage.setItem("theme", theme);
                updateThemeIcon(theme);
            }

            function updateThemeIcon(theme) {
                if (theme === "dark") {
                    themeIcon.classList.remove("fa-moon");
                    themeIcon.classList.add("fa-sun");
                } else {
                    themeIcon.classList.remove("fa-sun");
                    themeIcon.classList.add("fa-moon");
                }
            }

            const savedTheme = localStorage.getItem("theme");
            const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (savedTheme) {
                setTheme(savedTheme);
            } else if (prefersDark) {
                setTheme('dark');
            } else {
                setTheme('light');
            }
            themeToggle.addEventListener("click", () => {
                const currentTheme = html.getAttribute('data-theme');
                setTheme(currentTheme === "dark" ? "light" : "dark");
            });

            // Payment check and countdown logic
            const statusPayment = document.getElementById('statusPayment');
            const countdownElement = document.getElementById('countdown');
            const checkPaymentForm = document.getElementById('checkPaymentForm');
            const checkPaymentButton = checkPaymentForm ? checkPaymentForm.querySelector('button') : null;

            // Cek jika status pembayaran masih "pending"
            if (statusPayment && statusPayment.innerText.includes('Pending')) {

                // Fungsi untuk melakukan pengecekan status pembayaran
                const checkPaymentStatus = () => {
                    if (checkPaymentButton) {
                        checkPaymentButton.disabled = true;
                        checkPaymentButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Checking...';
                    }

                    const checkUrl = "{{ route('mutasi.manual', ['id' => $transaksi->id]) }}";
                    
                    fetch(checkUrl, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Payment check response:', data);
                        if (data.status === 'paid') {
                            // Jika pembayaran sudah lunas, refresh halaman untuk menampilkan akses produk
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error during payment check:', error);
                    })
                    .finally(() => {
                        if (checkPaymentButton) {
                            checkPaymentButton.disabled = false;
                            checkPaymentButton.innerHTML = '<i class="fas fa-sync-alt mr-2"></i> Check Payment Status';
                        }
                    });
                };

                // Panggil fungsi pengecekan otomatis setiap 1 detik
                const autoCheckInterval = setInterval(checkPaymentStatus, 1000); 

                // Menambahkan event listener pada tombol manual untuk memanggil fungsi yang sama
                if (checkPaymentForm) {
                    checkPaymentForm.addEventListener('submit', function(e) {
                        e.preventDefault(); // Mencegah reload halaman default
                        checkPaymentStatus();
                    });
                }

                // Logika hitung mundur pembayaran
                const created_at = new Date("{{ $transaksi->created_at }}");
                const expiry_time = created_at.getTime() + (24 * 60 * 60 * 1000); // 24 jam

                const countdownInterval = setInterval(() => {
                    const now = new Date().getTime();
                    const distance = expiry_time - now;

                    if (distance < 0) {
                        clearInterval(countdownInterval);
                        clearInterval(autoCheckInterval);
                        countdownElement.innerHTML = "EXPIRED";
                        if(statusPayment) {
                            statusPayment.classList.remove('bg-amber-100', 'text-amber-800');
                            statusPayment.classList.add('bg-red-100', 'text-red-800');
                            statusPayment.innerHTML = '<i class="fas fa-times-circle mr-1.5"></i> Expired';
                        }
                    } else {
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        countdownElement.innerHTML = `${hours}h ${minutes}m ${seconds}s`;
                    }
                }, 1000);
            }
        });
    </script>
</body>
</html>