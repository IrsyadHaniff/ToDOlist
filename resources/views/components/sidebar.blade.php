<div class="w-64 fixed h-screen bg-white dark:bg-gray-800 shadow-lg flex flex-col select-none">

    <!-- HEADER -->
    <div class="p-6 flex items-center space-x-3">
        <h2 class="text-2xl font-bold flex-1 dark:text-gray-200 ">ToDOlist
        </h2>

        <!-- ICON MATAHARI (tampil saat LIGHT MODE) -->
        <div class="w-6 h-6 flex items-center justify-center">
            <svg id="icon-light" class="w-6 h-6 cursor-pointer hidden dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 5V3m0 18v-2M7.05 7.05 5.636 5.636m12.728 12.728L16.95 16.95M5 12H3m18 0h-2M7.05 16.95l-1.414 1.414M18.364 5.636 16.95 7.05M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" />
            </svg>

            <!-- ICON BULAN (tampil saat DARK MODE) -->
            <svg id="icon-dark" class="w-6 h-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 21a9 9 0 0 1-.5-17.986V3c-.354.966-.5 1.911-.5 3a9 9 0 0 0 9 9c.239 0 .254.018.488 0A9.004 9.004 0 0 1 12 21Z" />
            </svg>
        </div>
    </div>

    <!-- Menu Items -->
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('beranda') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors
                            {{ Request::routeIs('beranda') ? 'bg-linear-to-bl from-violet-500 to-fuchsia-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Beranda</span>
                </a>
            </li>

            <li>
                <a href=""
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors
                            {{ Request::routeIs('kalender') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">Kalender</span>
                </a>
            </li>

            <li>
                <a href="{{ route('tugas.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors
                            {{ Request::routeIs('tugas.index') ? 'bg-linear-to-bl from-violet-500 to-fuchsia-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="font-medium">List Tugas</span>
                </a>
            </li>

            <li>
                <a href="{{ route('tugasSelesai') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors
                            {{ Request::routeIs('tugasSelesai') ? 'bg-linear-to-bl from-violet-500 to-fuchsia-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">Tugas Selesai</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Logout -->
    <div class="p-4">
        <form method="POST" action="">
            @csrf
            <button type="submit"
                class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-200 dark:hover:bg-red-600 dark:hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="font-medium">Log Out</span>
            </button>
        </form>
    </div>

</div>
