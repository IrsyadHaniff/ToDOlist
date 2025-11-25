@extends('layouts.app')

@section('title', 'ToDOlist - Beranda')

@section('content')

    <div class="header dark:text-gray-200 mb-6">
        <h1 class="text-3xl font-bold mb-2">Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400">Selamat datang kembali! Mari selesaikan tugas hari ini 🚀</p>
    </div>

    <!-- User Profile Section -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <!-- Profile Picture -->
        <div
            class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-6 flex flex-col items-center justify-center text-white shadow-lg">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-3 overflow-hidden">
                <img src="https://ui-avatars.com/api/?name=Irsyad+Hanif&size=200&background=3b82f6&color=fff" alt="Profile"
                    class="w-full h-full object-cover">
            </div>
            <h3 class="font-bold text-lg">Irsyad Haniff</h3>
            <p class="text-sm opacity-90">Mahasiswa</p>
        </div>

        <!-- Name -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Nama Lengkap</p>
            </div>
            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">Irsyad Hanif</p>
        </div>

        <!-- Email -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Email</p>
            </div>
            <p class="text-lg font-bold text-gray-900 dark:text-gray-100 truncate">hanif45v@gmail.com</p>
        </div>

        <!-- Phone -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600 dark:text-yellow-400"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">No. HP</p>
            </div>
            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">+62 881-0267-441</p>
        </div>

        <!-- Quick Stats -->
        <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl p-6 shadow-lg text-white">
            <p class="text-sm opacity-90 mb-2">Total Tugas</p>
            <p class="text-4xl font-bold mb-1">{{ $totalTugas }}</p>
            <div class="flex items-center gap-2 text-sm">
                <span class="flex items-center gap-1">
                    <span class="w-2 h-2 bg-yellow-300 rounded-full"></span>
                    {{ $totalAktif }} Aktif
                </span>
                <span class="flex items-center gap-1">
                    <span class="w-2 h-2 bg-green-300 rounded-full"></span>
                    {{ $totalSelesai }} Selesai
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- List Tugas Aktif -->
        <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-linear-to-bl from-violet-500 to-fuchsia-500 p-4 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white">📝 Tugas Aktif</h2>
                    <p class="text-sm text-green-100">Tugas yang sedang berjalan</p>
                </div>
                <a href="{{ route('tugas.index') }}"
                    class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-center text-sm transition-all">
                    Lihat Semua
                </a>
            </div>
            <div class="p-4 space-y-3 overflow-y-auto">
                @forelse($tugasAktif as $item)
                    @php
                        $deadline = \Carbon\Carbon::parse($item->deadline);
                        $today = \Carbon\Carbon::today();
                        $isOverdue = $deadline->isPast();
                        $isToday = $deadline->isToday();
                        $isUpcoming = $deadline->isTomorrow();

                        $jenisColors = [
                            'Praktikum' =>
                                'bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 border-purple-500',
                            'Teori' => 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 border-blue-500',
                            'Tugas' =>
                                'bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 border-orange-500',
                            'Quiz' => 'bg-pink-100 dark:bg-pink-900 text-pink-800 dark:text-pink-200 border-pink-500',
                            'UTS' => 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 border-red-500',
                            'UAS' => 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 border-red-500',
                        ];
                        $colorClass =
                            $jenisColors[$item->jenis] ??
                            'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border-gray-500';
                    @endphp
                    <div
                        class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 hover:shadow-md transition-all border-l-4 {{ explode(' ', $colorClass)[count(explode(' ', $colorClass)) - 1] }}">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-bold text-gray-900 dark:text-gray-100">{{ $item->nama_matakuliah }}</h3>
                            <span class="px-2 py-1 {{ $colorClass }} text-xs rounded-full">{{ $item->jenis }}</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ Str::limit($item->tugas, 40) }}</p>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $item->deadline_format }}
                            </span>
                            @if ($isOverdue)
                                <span
                                    class="px-2 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full flex items-center gap-1 animate-pulse">
                                    ⚠️ TERLAMBAT
                                </span>
                            @elseif($isToday)
                                <span
                                    class="px-2 py-1 bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 rounded-full flex items-center gap-1 animate-pulse">
                                    🔥 HARI INI
                                </span>
                            @elseif($isUpcoming)
                                <span
                                    class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full flex items-center gap-1 animate-pulse">
                                    ⏰ BESOK
                                </span>
                            @else
                                <span
                                    class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full flex items-center gap-1">
                                    🔄 {{ $item->status }}
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-16 w-16 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada tugas aktif</p>
                        <a href="{{ route('tugas.create') }}"
                            class="text-blue-600 dark:text-blue-400 text-sm mt-2 inline-block hover:underline">+ Tambah
                            Tugas Baru</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Center Column - Iconic & Calendar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Iconic ToDoList -->
            <div
                class="bg-gradient-to-br from-yellow-400 via-orange-400 to-pink-500 rounded-2xl shadow-lg p-8 flex flex-col items-center justify-center text-white min-h-64">
                <div class="text-8xl mb-4 animate-bounce">📋</div>
                <h2 class="text-2xl font-bold mb-2">ToDo List</h2>
                <p class="text-center text-sm opacity-90">Kelola tugas kuliah dengan mudah dan terorganisir</p>
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('tugas.create') }}"
                        class="bg-white/20 hover:bg-white/30 backdrop-blur-sm px-6 py-2 rounded-lg font-semibold transition-all">
                        + Tambah Tugas
                    </a>
                </div>
            </div>

            <!-- Mini Calendar -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">📅 November 2025</h3>
                    <button class="text-blue-600 dark:text-blue-400 text-sm hover:underline">Lihat Kalender →</button>
                </div>
                <div class="grid grid-cols-7 gap-2 text-center text-sm">
                    <div class="text-gray-500 dark:text-gray-400 font-semibold">Min</div>
                    <div class="text-gray-500 dark:text-gray-400 font-semibold">Sen</div>
                    <div class="text-gray-500 dark:text-gray-400 font-semibold">Sel</div>
                    <div class="text-gray-500 dark:text-gray-400 font-semibold">Rab</div>
                    <div class="text-gray-500 dark:text-gray-400 font-semibold">Kam</div>
                    <div class="text-gray-500 dark:text-gray-400 font-semibold">Jum</div>
                    <div class="text-gray-500 dark:text-gray-400 font-semibold">Sab</div>

                    <div class="text-gray-400 dark:text-gray-600">27</div>
                    <div class="text-gray-400 dark:text-gray-600">28</div>
                    <div class="text-gray-400 dark:text-gray-600">29</div>
                    <div class="text-gray-400 dark:text-gray-600">30</div>
                    <div class="text-gray-400 dark:text-gray-600">31</div>
                    <div
                        class="text-gray-900 dark:text-gray-100 p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg cursor-pointer">
                        1</div>
                    <div
                        class="text-gray-900 dark:text-gray-100 p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg cursor-pointer">
                        2</div>

                    @for ($i = 3; $i <= 30; $i++)
                        @if ($i == 25)
                            <div class="bg-blue-600 text-white p-2 rounded-lg font-bold">{{ $i }}</div>
                        @elseif($i == 23 || $i == 27)
                            <div
                                class="text-gray-900 dark:text-gray-100 p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg cursor-pointer relative">
                                {{ $i }}
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                            </div>
                        @else
                            <div
                                class="text-gray-900 dark:text-gray-100 p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg cursor-pointer">
                                {{ $i }}</div>
                        @endif
                    @endfor
                </div>
                <div class="mt-4 flex items-center gap-4 text-xs text-gray-600 dark:text-gray-400">
                    <div class="flex items-center gap-1">
                        <span class="w-3 h-3 bg-blue-600 rounded-full"></span>
                        Hari ini
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                        Ada deadline
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Tugas Selesai & Pencapaian -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Tugas Selesai -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-emerald-800 p-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white">✅ Tugas Selesai</h2>
                        <p class="text-sm text-purple-100">Tugas yang sudah diselesaikan</p>
                    </div>
                    <a href="{{ route('tugasSelesai') }}"
                        class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 text-center rounded-lg text-sm transition-all">
                        Lihat Semua
                    </a>
                </div>
                <div class="p-4 space-y-3 max-h-80 overflow-y-auto">
                    @forelse($tugasSelesai as $item)
                        <div
                            class="bg-green-50 dark:bg-green-900/20 rounded-xl p-4 hover:shadow-md transition-all border-l-4 border-green-500">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="font-bold text-gray-900 dark:text-gray-100">{{ $item->nama_matakuliah }}</h3>
                                <span
                                    class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs rounded-full">✓</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ Str::limit($item->tugas, 40) }}
                            </p>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-500 dark:text-gray-400">Selesai:
                                    {{ $item->deadline_format }}</span>
                                <span class="text-green-600 dark:text-green-400 font-semibold">100%</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-16 w-16 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada tugas selesai</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Selesaikan tugas untuk melihatnya di
                                sini</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pencapaian -->
            <div class="bg-gradient-to-br from-pink-500 via-rose-500 to-red-500 rounded-2xl shadow-lg p-6 text-white">
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                    🏆 Pencapaian
                </h2>
                <div class="space-y-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm">Tugas Selesai</span>
                            <span class="text-2xl font-bold">{{ $totalSelesai }}/{{ $totalTugas }}</span>
                        </div>
                        <div class="w-full bg-white/20 rounded-full h-2">
                            @php
                                $percentage = $totalTugas > 0 ? ($totalSelesai / $totalTugas) * 100 : 0;
                            @endphp
                            <div class="bg-white rounded-full h-2" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm">Streak Mingguan</span>
                            <span class="text-2xl font-bold">5 🔥</span>
                        </div>
                        <p class="text-xs opacity-80">Konsisten 5 hari berturut-turut!</p>
                    </div>

                    <div class="grid grid-cols-3 gap-2">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-2xl mb-1">🎯</div>
                            <div class="text-xs">Fokus</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-2xl mb-1">⚡</div>
                            <div class="text-xs">Cepat</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-2xl mb-1">🌟</div>
                            <div class="text-xs">Hebat</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
        /* Custom scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: transparent;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 3px;
        }

        .dark .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #4a5568;
        }
    </style>

@endsection
