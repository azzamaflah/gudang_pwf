<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a
                        href="{{ Auth::check() && Auth::user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (Auth::check() && Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-nav-link>
                        <x-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')">Kategori</x-nav-link>
                        <x-nav-link :href="route('rak.index')" :active="request()->routeIs('rak.*')">Rak</x-nav-link>
                        <x-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.*')">Barang</x-nav-link>
                        <x-nav-link :href="route('transaksi-masuk.index')" :active="request()->routeIs('transaksi-masuk.*')">Transaksi Masuk</x-nav-link>
                        <x-nav-link :href="route('transaksi-keluar.index')" :active="request()->routeIs('transaksi-keluar.*')">Transaksi Keluar</x-nav-link>
                        <x-nav-link :href="route('admin.permintaan-barang.index')" :active="request()->routeIs('admin.permintaan-barang.*')">Kelola Permintaan</x-nav-link>
                    @elseif (Auth::check() && Auth::user()->role === 'user')
                        <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">Dashboard</x-nav-link>
                        <x-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.*')">Barang</x-nav-link>
                        <x-nav-link :href="route('permintaan-barang.index')" :active="request()->routeIs('permintaan-barang.*')">Permintaan Barang</x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::check() && Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')">Kategori</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('rak.index')" :active="request()->routeIs('rak.*')">Rak</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.*')">Barang</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('transaksi-masuk.index')" :active="request()->routeIs('transaksi-masuk.*')">Transaksi Masuk</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('transaksi-keluar.index')" :active="request()->routeIs('transaksi-keluar.*')">Transaksi Keluar</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.permintaan-barang.index')" :active="request()->routeIs('admin.permintaan-barang.*')">Kelola Permintaan</x-responsive-nav-link>
            @elseif (Auth::check() && Auth::user()->role === 'user')
                <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.*')">Barang</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('permintaan-barang.index')" :active="request()->routeIs('permintaan-barang.*')">Permintaan Barang</x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
