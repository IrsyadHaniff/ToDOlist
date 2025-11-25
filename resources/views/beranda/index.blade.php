@extends('layouts.app')

@section('title', 'ToDOlist - Beranda')

@section('content')

<div class="header dark:text-gray-200">
    <h1 class="text-3xl font-bold">Halaman Beranda</h1>
    <p>halo wokk</p>
</div>
<div class="grid grid-cols-5 grid-rows-5 gap-2 w-full p-4">

    <div class="bg-blue-200 p-3 flex justify-center items-center rounded-sm">Nama</div>
    <div class="bg-blue-200 p-3 flex justify-center items-center rounded-sm">Email</div>
    <div class="bg-blue-200 p-3 flex justify-center items-center rounded-sm">Password</div>
    <div class="bg-blue-200 p-3 flex justify-center items-center rounded-sm">No hp</div>
    <div class="bg-blue-200 p-3 flex justify-center items-center rounded-sm">Foto</div>

    <!-- List Tugas -->
    <div class="bg-green-200 p-3 flex justify-center items-center col-span-2 row-span-3 rounded-xl">
        List tugas
    </div>

    <!-- Iconic ToDoList -->
    <div class="bg-yellow-200 p-3 flex justify-center items-center row-span-3 col-start-3 rounded-2xl">
        Iconic todolist/img
    </div>

    <!-- Kalender -->
    <div class="bg-red-200 p-3 flex justify-center items-center col-span-2 row-span-3 col-start-4 rounded-xl">
        Kalender
    </div>

    <!-- Tugas Selesai -->
    <div class="bg-purple-200 p-3 flex justify-center items-center col-span-2 row-start-5 rounded-md">
        Tugas selesai
    </div>

    <!-- Pencapaian -->
    <div class="bg-pink-200 p-3 flex justify-center items-center col-span-2 col-start-4 row-start-5 rounded-md">
        Pencapaian
    </div>

</div>



@endsection
