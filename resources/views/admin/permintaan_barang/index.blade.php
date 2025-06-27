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

            <div class="bg-white dark:bg-gray-800 p-6 shadow rounded text-gray-900 dark:text-white">
                <table class="table-auto w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Barang</th>
                            <th class="px-4 py-2">Jumlah</th>
                            <th class="px-4 py-2">Keterangan</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permintaans as $p)
                            <tr>
                                <td class="border px-4 py-2">{{ $p->user->name }}</td>
                                <td class="border px-4 py-2">{{ $p->barang->nama_barang }}</td>
                                <td class="border px-4 py-2">{{ $p->jumlah }}</td>
                                <td class="border px-4 py-2">{{ $p->keterangan }}</td>
                                <td class="border px-4 py-2">{{ ucfirst($p->status) }}</td>
                                <td class="border px-4 py-2">
                                    @if ($p->status === 'pending')
                                        <form action="{{ route('admin.permintaan-barang.approve', $p->id) }}"
                                            method="POST">

                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 text-xs">✔
                                                Setujui</button>
                                        </form>


                                        <form action="{{ route('admin.permintaan-barang.reject', ['id' => $p->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-xs">✖
                                                Tolak</button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 text-xs italic">Sudah diproses</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
