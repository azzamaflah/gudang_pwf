<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaksi Barang Keluar') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('transaksi-keluar.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
                + Tambah Transaksi Keluar
            </a>

            <table class="table-auto w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">Barang</th>
                        <th class="border px-4 py-2">Jumlah</th>
                        <th class="border px-4 py-2">Tanggal Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $trx)
                        <tr>
                            <td class="border px-4 py-2">{{ $trx->barang->nama_barang ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $trx->jumlah }}</td>
                            <td class="border px-4 py-2">{{ $trx->tanggal_keluar }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-500 py-2">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
