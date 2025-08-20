@extends('layouts.app') {{-- Assuming a layout file exists --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Riwayat Transaksi Saya</h1>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Produk</th>
                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Tanggal</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Total</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($transaksis as $transaksi)
                    <tr>
                        <td class="w-1/3 text-left py-3 px-4">{{ $transaksi->produk->nama }}</td>
                        <td class="w-1/3 text-left py-3 px-4">{{ $transaksi->created_at->format('d M Y, H:i') }}</td>
                        <td class="text-left py-3 px-4">Rp {{ number_format($transaksi->amount, 0, ',', '.') }}</td>
                        <td class="text-left py-3 px-4">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-sm
                                @if($transaksi->status == 'paid') bg-green-100 text-green-700 @else bg-yellow-100 text-yellow-700 @endif">
                                {{ ucfirst($transaksi->status) }}
                            </span>
                        </td>
                        <td class="text-left py-3 px-4">
                            <a href="{{ route('invoice.show', $transaksi->id) }}" class="text-indigo-600 hover:text-indigo-900">Lihat Invoice</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Anda belum memiliki transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $transaksis->links() }}
    </div>
</div>
@endsection
