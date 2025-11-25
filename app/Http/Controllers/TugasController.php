<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tugas::query();

        // Filter berdasarkan Jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Filter berdasarkan Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        $sort = $request->get('sort', 'deadline_asc');

        switch ($sort) {
            case 'deadline_desc':
                $query->orderBy('deadline', 'desc');
                break;
            case 'tanggal_asc':
                $query->orderBy('tanggal', 'asc');
                break;
            case 'tanggal_desc':
                $query->orderBy('tanggal', 'desc');
                break;
            default: // deadline_asc
                $query->orderBy('deadline', 'asc');
                break;
        }

        $tugas = $query->get();

        return view('listTugas.index', compact('tugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listTugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_matakuliah' => 'required|string|max:255',
            'tugas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis' => 'required|in:Praktikum,Teori,Tugas,Quiz,UTS,UAS',
            'deadline' => 'required|date',
            // 'status' => 'required|in:Belum Mulai,Berlangsung,Selesai',
        ]);

        // Set status default
        $validated['status'] = 'Berlangsung';

        Tugas::create($validated);

        return redirect()->route('tugas.index')
            ->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tugas $tugas)
    {
        return view('listTugas.show', compact('tugas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tugas $tugas)
    {
        return view('listTugas.edit', compact('tugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tugas $tugas)
    {
        // Debug: Cek apakah $tugas ada
        if (!$tugas || !$tugas->id) {
            return redirect()->route('listTugas')
                ->with('error', 'Tugas tidak ditemukan!');
        }

        // Cek apakah request cuma update status (dari dropdown)
        if ($request->has('status') && count($request->all()) <= 3) {
            $validated = $request->validate([
                'status' => 'required|in:Belum Mulai,Berlangsung,Selesai',
            ]);

            $tugas->update($validated);

            return redirect()->route('listTugas')
                ->with('success', 'Status berhasil diupdate!');
        }

        // Request dari form edit lengkap
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_matakuliah' => 'required|string|max:255',
            'tugas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis' => 'required|in:Praktikum,Teori,Tugas,Quiz,UTS,UAS',
            'deadline' => 'required|date',
            'status' => 'required|in:Belum Mulai,Berlangsung,Selesai',
        ]);

        $tugas->update($validated);

        return redirect()->route('listTugas')
            ->with('success', 'Tugas berhasil diupdate!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tugas $tugas)
    {
        $tugas->delete();

        return redirect()->route('listTugas.index')
            ->with('success', 'Tugas berhasil dihapus!');
    }

    // Method untuk halaman Tugas Selesai
    public function tugasSelesai(Request $request)
    {
        $query = Tugas::where('status', 'Selesai');

        // Filter berdasarkan Jenis (opsional)
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Sorting
        $sort = $request->get('sort', 'deadline_desc');

        switch ($sort) {
            case 'deadline_asc':
                $query->orderBy('deadline', 'asc');
                break;
            case 'tanggal_asc':
                $query->orderBy('tanggal', 'asc');
                break;
            case 'tanggal_desc':
                $query->orderBy('tanggal', 'desc');
                break;
            default: // deadline_desc
                $query->orderBy('deadline', 'desc');
                break;
        }

        $tugas = $query->get();

        return view('tugasSelesai.index', compact('tugas'));
    }
}
