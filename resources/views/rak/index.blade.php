<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Rak') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm rounded">

                {{-- Flash message sukses --}}
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('rak.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Tambah Rak
                </a>

                <table class="table-auto w-full mt-4 border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Kode Rak</th>
                            <th class="border px-4 py-2 text-left">Lokasi</th>
                            <th class="border px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($raks as $rak)
                            <tr>
                                <td class="border px-4 py-2">{{ $rak->kode_rak }}</td>
                                <td class="border px-4 py-2">{{ $rak->lokasi }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('rak.edit', $rak->id) }}"
                                        class="text-blue-600 hover:underline">Edit</a> |
                                    <form action="{{ route('rak.destroy', $rak->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin hapus?')"
                                            class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-500 py-4">Belum ada data rak.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
