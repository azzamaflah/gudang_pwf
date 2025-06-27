<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Riwayat Barang Masuk</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('transaksi-masuk.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
                    + Tambah Barang Masuk
                </a>

                <table class="table-auto w-full border border-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-white">
                        <tr>
                            <th class="border px-4 py-2">Tanggal</th>
                            <th class="border px-4 py-2">Nama Barang</th>
                            <th class="border px-4 py-2">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksis as $trx)
                            <tr>
                                <td class="border px-4 py-2">{{ $trx->tanggal_masuk }}</td>
                                <td class="border px-4 py-2">{{ $trx->barang->nama_barang }}</td>
                                <td class="border px-4 py-2">{{ $trx->jumlah }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-500">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
