<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Total Barang</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalBarang }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Masuk Bulan Ini</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $masukBulanIni }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Keluar Bulan Ini</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $keluarBulanIni }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">
                    Barang dengan Stok Kritis (Stok < 5) </h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-300">
                                <thead
                                    class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase text-xs">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Nama Barang</th>
                                        <th scope="col" class="px-6 py-3">Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($stokKritis as $barang)
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="px-6 py-4">{{ $barang->nama_barang }}</td>
                                            <td class="px-6 py-4">{{ $barang->stok }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="px-6 py-4 text-center">Tidak ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">
                    Grafik Transaksi Barang (12 Bulan Terakhir)
                </h3>
                <canvas id="chartTransaksi" height="100"></canvas>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('chartTransaksi').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($bulanLabels),
                    datasets: [{
                            label: 'Transaksi Masuk',
                            backgroundColor: 'rgba(59, 130, 246, 0.7)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1,
                            data: @json($dataMasuk),
                        },

                        {
                            label: 'Transaksi Keluar',
                            backgroundColor: '#ef4444',
                            data: @json($dataKeluar),
                        },
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            labels: {
                                color: '#fff'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#fff'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#fff'
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
