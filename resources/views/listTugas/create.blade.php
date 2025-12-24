@extends('layouts.app')

@section('title', 'ToDOlist - Create/listTugas')

@section('content')
    <div class="header dark:text-gray-200 mb-6">
        <h1 class="text-3xl font-bold mb-2">Create Tugas</h1>
        <p class="text-gray-600 dark:text-gray-400">Membuat tugas kuliah Kamu disini</p>
    </div>

    <div class="max-w-4xl">
        <!-- Card Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="bg-linear-to-bl from-violet-500 to-fuchsia-500 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">Form Tambah Tugas Baru</h2>
            </div>

            <form action="{{ route('tugas.store') }}" method="POST" class="p-6">
                @csrf

                <!-- Grid Layout untuk Form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Tanggal -->
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-200 transition-all"
                            required>
                        @error('tanggal')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Matakuliah -->
                    <div>
                        <label for="nama_matakuliah"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nama Matakuliah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_matakuliah" name="nama_matakuliah"
                            value="{{ old('nama_matakuliah') }}" placeholder="Contoh: Pemrograman Web"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-200 transition-all"
                            required>
                        @error('nama_matakuliah')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Tugas -->
                    <div>
                        <label for="tugas" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nama Tugas <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="tugas" name="tugas" value="{{ old('tugas') }}"
                            placeholder="Contoh: CRUD Laravel"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-200 transition-all"
                            required>
                        @error('tugas')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis -->
                    <div>
                        <label for="jenis" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Jenis Tugas <span class="text-red-500">*</span>
                        </label>
                        <select id="jenis" name="jenis"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-200 transition-all"
                            required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Praktikum" {{ old('jenis') == 'Praktikum' ? 'selected' : '' }}>Praktikum</option>
                            <option value="Teori" {{ old('jenis') == 'Teori' ? 'selected' : '' }}>Teori</option>
                            <option value="Tugas" {{ old('jenis') == 'Tugas' ? 'selected' : '' }}>Tugas</option>
                            <option value="Quiz" {{ old('jenis') == 'Quiz' ? 'selected' : '' }}>Quiz</option>
                            <option value="UTS" {{ old('jenis') == 'UTS' ? 'selected' : '' }}>UTS</option>
                            <option value="UAS" {{ old('jenis') == 'UAS' ? 'selected' : '' }}>UAS</option>
                        </select>
                        @error('jenis')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deadline -->
                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Deadline <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="deadline" name="deadline" value="{{ old('deadline') }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-200 transition-all"
                            required>
                        @error('deadline')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi (Full Width) -->
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Deskripsi
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi detail tugas (opsional)"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-200 transition-all resize-none">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('tugas.create') }}"
                        class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all font-medium">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition-all transform hover:scale-105 font-medium flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Simpan Tugas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Custom focus style */
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
        }

        /* Date input custom style */
        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            filter: invert(0.5);
        }

        .dark input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(0.8);
        }
    </style>
@endsection
