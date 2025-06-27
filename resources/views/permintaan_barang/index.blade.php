<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Permintaan Barang
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('permintaan-barang.create') }}"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow">
                    + Buat Permintaan
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 shadow rounded-lg text-gray-900 dark:text-white">
                <table class="w-full table-auto text-sm border border-gray-300">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">Nama Barang</th>
                            <th class="px-4 py-2 border">Jumlah</th>
                            <th class="px-4 py-2 border">Keterangan</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permintaans as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="border px-4 py-2">{{ $item->barang->nama_barang }}</td>
                                <td class="border px-4 py-2">{{ $item->jumlah }}</td>
                                <td class="border px-4 py-2">{{ $item->keterangan ?? '-' }}</td>
                                <td class="border px-4 py-2 capitalize">{{ $item->status }}</td>
                                <td class="border px-4 py-2">{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">Belum ada permintaan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
