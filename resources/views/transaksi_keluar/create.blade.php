<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Transaksi Barang Keluar') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul class="list-disc pl-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('transaksi-keluar.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Barang</label>
                        <select name="barang_id" class="w-full border-gray-300 rounded">
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama_barang }} (Stok:
                                    {{ $barang->stok }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Jumlah</label>
                        <input type="number" name="jumlah" class="w-full border-gray-300 rounded" min="1"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" class="w-full border-gray-300 rounded" required>
                    </div>

                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
