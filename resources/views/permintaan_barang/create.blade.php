<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Buat Permintaan Barang
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('permintaan-barang.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm text-gray-600 dark:text-gray-300">Pilih Barang</label>
                        <select name="barang_id" class="w-full mt-1">
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm text-gray-600 dark:text-gray-300">Jumlah</label>
                        <input type="number" name="jumlah" class="w-full mt-1" min="1" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm text-gray-600 dark:text-gray-300">Keterangan</label>
                        <textarea name="keterangan" class="w-full mt-1"></textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Kirim Permintaan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
