<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Barang') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm rounded">
                <form method="POST" action="{{ route('barang.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-input w-full" required>
                        @error('nama_barang')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block">Kategori</label>
                        <select name="kategori_id" class="form-select w-full" required>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block">Rak</label>
                        <select name="rak_id" class="form-select w-full" required>
                            @foreach ($raks as $rak)
                                <option value="{{ $rak->id }}">{{ $rak->kode_rak }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block">Stok</label>
                        <input type="number" name="stok" class="form-input w-full" min="0" required>
                        @error('stok')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
