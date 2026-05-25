<aside class="w-64 bg-gray-800 text-white flex-shrink-0">
    <div class="p-4 text-xl font-bold">Sidebar</div>
    <nav class="mt-4">
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : '' }}">
                    Admin Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.users.*') ? 'bg-gray-900' : '' }}">
                    Manage Users
                </a>
                <a href="{{ route('admin.articles.index') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.articles.*') ? 'bg-gray-900' : '' }}">
                    Manage Artikel
                </a>
                <a href="{{ route('admin.pengumuman-masjid.index') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.pengumuman-masjid.*') ? 'bg-gray-900' : '' }}">
                    Pengumuman Masjid
                </a>
                <a href="{{ route('admin.keuangan.index') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.keuangan.*') ? 'bg-gray-900' : '' }}">
                    Keuangan Masjid
                </a>
                <a href="{{ route('admin.asets.index') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.asets.*') ? 'bg-gray-900' : '' }}">
                    Aset Masjid
                </a>
                <a href="{{ route('admin.agenda-kajian.index') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.agenda-kajian.*') ? 'bg-gray-900' : '' }}">
                    Agenda Kajian
                </a>
                <a href="{{ route('admin.ustadz.index') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.ustadz.*') ? 'bg-gray-900' : '' }}">
                    Ustad
                </a>
                <a href="{{ route('admin.jadwal-petugas.index') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.jadwal-petugas.*') ? 'bg-gray-900' : '' }}">
                    Jadwal Petugas
                </a>
            @endif

            @if(Auth::user()->role === 'user')
                <a href="{{ route('users.dashboard') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('users.dashboard') ? 'bg-gray-900' : '' }}">
                    User Dashboard
                </a>
                <a href="{{ route('users.profile') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('users.profile') ? 'bg-gray-900' : '' }}">
                    Profile
                </a>
                <a href="{{ route('users.articles') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('users.articles') ? 'bg-gray-900' : '' }}">
                    Artikel Masjid
                </a>
                <a href="{{ route('pengumuman.index') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('pengumuman.*') ? 'bg-gray-900' : '' }}">
                    Pengumuman Masjid
                </a>
                <a href="{{ route('users.keuangan.laporan') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('users.keuangan.*') ? 'bg-gray-900' : '' }}">
                    Laporan Keuangan
                </a>
                <a href="{{ route('users.agenda-kajian.index') }}"
                    class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('users.agenda-kajian.*') ? 'bg-gray-900' : '' }}">
                    Agenda Kajian
                </a>
            @endif
        @endauth
    </nav>
</aside>