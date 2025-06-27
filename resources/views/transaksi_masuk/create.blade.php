<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Tambah Barang Masuk</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 p-6 rounded shadow">
            <form action="{{ route('transaksi-masuk.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1 text-gray-700 dark:text-gray-200">Pilih Barang</label>
                    <select name="barang_id" class="w-full border rounded p-2">
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-gray-700 dark:text-gray-200">Jumlah</label>
                    <input type="number" name="jumlah" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-gray-700 dark:text-gray-200">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="w-full border rounded p-2" required>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
