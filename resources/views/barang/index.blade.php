<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Barang') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm rounded text-gray-900 dark:text-white">

                {{-- Flash Message --}}
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tombol Aksi (Hanya Admin) --}}
                @if (Auth::user()->role === 'admin')
                    <div class="mb-4 space-x-2">
                        <a href="{{ route('barang.create') }}"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow">
                            + Tambah Barang
                        </a>

                        <a href="{{ route('admin.barang.export-pdf') }}"
                            class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 shadow">
                            📄 Export PDF
                        </a>
                    </div>
                @endif

                {{-- Tabel Data --}}
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border border-gray-300 bg-white dark:bg-gray-700 text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white">
                            <tr>
                                <th class="border px-4 py-2">Nama Barang</th>
                                <th class="border px-4 py-2">Kategori</th>
                                <th class="border px-4 py-2">Rak</th>
                                <th class="border px-4 py-2">Stok</th>
                                @if (Auth::user()->role === 'admin')
                                    <th class="border px-4 py-2">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barangs as $barang)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="border px-4 py-2">{{ $barang->nama_barang }}</td>
                                    <td class="border px-4 py-2">{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                                    <td class="border px-4 py-2">{{ $barang->rak->kode_rak ?? '-' }}</td>
                                    <td class="border px-4 py-2">{{ $barang->stok }}</td>
                                    @if (Auth::user()->role === 'admin')
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('barang.edit', $barang->id) }}"
                                                class="text-blue-600 hover:underline">Edit</a> |
                                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Hapus data ini?')"
                                                    class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ Auth::user()->role === 'admin' ? 5 : 4 }}"
                                        class="text-center py-4 text-gray-500">Belum ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
