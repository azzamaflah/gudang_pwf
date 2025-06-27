<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Rak') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm rounded">
                <form method="POST" action="{{ route('rak.update', $rak->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block">Kode Rak</label>
                        <input type="text" name="kode_rak" value="{{ $rak->kode_rak }}" class="form-input w-full" required>
                        @error('kode_rak') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ $rak->lokasi }}" class="form-input w-full" required>
                        @error('lokasi') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
