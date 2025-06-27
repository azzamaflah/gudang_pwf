<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Pengguna
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <p class="text-gray-700 dark:text-gray-200 text-lg">Selamat datang, {{ Auth::user()->name }}!</p>
                <p class="text-gray-500 mt-2">Berikut ringkasan aktivitas Anda:</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded shadow text-center">
                        <p class="text-sm">Total Barang</p>
                        <p class="text-2xl font-bold">{{ $totalBarang }}</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-900 p-4 rounded shadow text-center">
                        <p class="text-sm">Barang Masuk</p>
                        <p class="text-2xl font-bold">{{ $masukBulanIni }}</p>
                    </div>
                    <div class="bg-red-100 dark:bg-red-900 p-4 rounded shadow text-center">
                        <p class="text-sm">Barang Keluar</p>
                        <p class="text-2xl font-bold">{{ $keluarBulanIni }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
