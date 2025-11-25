@extends('layouts.app')

@section('title', 'ToDOlist - Tugas Selesai')

@section('content')
    <div class="header dark:text-gray-200 mb-6">
        <h1 class="text-3xl font-bold mb-2">Halaman Tugas Selesai</h1>
        <p class="text-gray-600 dark:text-gray-400">Daftar tugas yang sudah diselesaikan</p>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons mb-6 flex flex-wrap gap-3 items-center justify-between">
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('listTugas') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali ke List Tugas
            </a>
            
            <button class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                Export
            </button>
        </div>

        <!-- Filter & Sort Form -->
        <form method="GET" action="{{ route('tugasSelesai') }}" class="flex flex-wrap gap-3 items-center">
            <!-- Filter Jenis -->
            <div class="relative">
                <select name="jenis" 
                        onchange="this.form.submit()"
                        class="px-4 py-2.5 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-200 transition-all cursor-pointer appearance-none bg-white dark:bg-gray-700">
                    <option value="">🔍 Semua Jenis</option>
                    <option value="Praktikum" {{ request('jenis') == 'Praktikum' ? 'selected' : '' }}>Praktikum</option>
                    <option value="Teori" {{ request('jenis') == 'Teori' ? 'selected' : '' }}>Teori</option>
                    <option value="Tugas" {{ request('jenis') == 'Tugas' ? 'selected' : '' }}>Tugas</option>
                    <option value="Quiz" {{ request('jenis') == 'Quiz' ? 'selected' : '' }}>Quiz</option>
                    <option value="UTS" {{ request('jenis') == 'UTS' ? 'selected' : '' }}>UTS</option>
                    <option value="UAS" {{ request('jenis') == 'UAS' ? 'selected' : '' }}>UAS</option>
                </select>
            </div>

            <!-- Sort -->
            <div class="relative">
                <select name="sort" 
                        onchange="this.form.submit()"
                        class="px-4 py-2.5 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-200 transition-all cursor-pointer appearance-none bg-white dark:bg-gray-700">
                    <option value="deadline_desc" {{ request('sort', 'deadline_desc') == 'deadline_desc' ? 'selected' : '' }}>📅 Deadline (Terbaru)</option>
                    <option value="deadline_asc" {{ request('sort') == 'deadline_asc' ? 'selected' : '' }}>📅 Deadline (Terlama)</option>
                    <option value="tanggal_asc" {{ request('sort') == 'tanggal_asc' ? 'selected' : '' }}>📆 Tanggal (Lama)</option>
                    <option value="tanggal_desc" {{ request('sort') == 'tanggal_desc' ? 'selected' : '' }}>📆 Tanggal (Baru)</option>
                </select>
            </div>

            <!-- Reset Button -->
            @if(request('jenis') || request('sort'))
            <a href="{{ route('tugasSelesai') }}" 
               class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                Reset
            </a>
            @endif
        </form>
    </div>

    <div class="tables-container bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-green-600 to-green-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Matakuliah</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Tugas</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Deadline</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($tugas as $item)
                    <tr class="hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            {{ $item->tanggal_format }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-200">
                            {{ $item->nama_matakuliah }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                            {{ $item->tugas }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                            @if($item->deskripsi)
                                <div class="space-y-1">
                                    @foreach(explode("\n", $item->deskripsi) as $line)
                                        @if(trim($line))
                                            <div class="flex items-start gap-2">
                                                <span class="text-green-600 dark:text-green-400 font-bold mt-0.5">•</span>
                                                <span>{{ trim($line) }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $jenisColors = [
                                    'Praktikum' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
                                    'Teori' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                    'Tugas' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
                                    'Quiz' => 'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200',
                                    'UTS' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                    'UAS' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                ];
                            @endphp
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $jenisColors[$item->jenis] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $item->jenis }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            {{ $item->deadline_format }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    ✅ Selesai
                                </span>
                                <!-- Tombol untuk kembalikan ke status lain jika perlu -->
                                <form action="{{ route('tugas.update', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="Berlangsung">
                                    <button type="submit" 
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                            title="Kembalikan ke Berlangsung">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-lg font-semibold mb-2">Belum ada tugas selesai</p>
                                <p class="text-sm">Selesaikan tugas dari halaman List Tugas</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <style>
        /* Custom scrollbar */
        .tables-container::-webkit-scrollbar {
            height: 8px;
        }
        
        .tables-container::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .dark .tables-container::-webkit-scrollbar-track {
            background: #374151;
        }
        
        .tables-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        
        .tables-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
@endsection