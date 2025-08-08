<x-filament::page>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Mutasi QR
            </h2>
        </div>

        @if (isset($this->mutasi['error']))
            <div class="p-4 bg-danger-50 border border-danger-200 text-danger-700 rounded-md">
                {{ $this->mutasi['error'] }}
            </div>
        @elseif (isset($this->mutasi['result']))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($this->mutasi['result'] as $item)
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 shadow-sm hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <p class="text-sm text-gray-400">{{ $item['tanggal'] }}</p>
                                <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $item['keterangan'] }}
                                </h3>
                            </div>
                            <div class="flex items-center gap-2">
                                <img src="{{ $item['brand']['logo'] }}" alt="brand" class="w-6 h-6 rounded-full" />
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $item['brand']['name'] }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-2 space-y-1">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Kredit</span>
                                <span class="text-success-600 dark:text-success-400 font-bold inline-flex items-center gap-1">
                                    {{-- Inline SVG --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Rp {{ number_format((float) str_replace('.', '', $item['kredit']), 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Saldo Akhir</span>
                                <span class="text-primary-600 dark:text-primary-400 font-semibold">
                                    Rp {{ number_format((float) str_replace('.', '', $item['saldo_akhir']), 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Tidak ada data mutasi ditemukan.
            </div>
        @endif
    </div>
</x-filament::page>
