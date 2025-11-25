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
        // Query tugas yang BELUM selesai 
        $query = Tugas::where('status', '!=', 'Selesai');

        // Filter berdasarkan Jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Filter berdasarkan Status (Belum Mulai & Berlangsung)
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
    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('listTugas.show', compact('tugas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('listTugas.edit', compact('tugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Cari tugas berdasarkan ID
        $tugas = Tugas::find($id);

        // DEBUGGING
        Log::info('=== UPDATE REQUEST START ===');
        Log::info('ID dari Route: ' . $id);
        Log::info('Tugas Found: ' . ($tugas ? 'YES' : 'NO'));
        if ($tugas) {
            Log::info('Tugas ID: ' . $tugas->id);
            Log::info('Tugas Status Lama: ' . $tugas->status);
        }
        Log::info('Request All: ', $request->all());
        Log::info('Request Except Token & Method: ', $request->except(['_token', '_method']));

        // Debug: Cek apakah $tugas ada
        if (!$tugas) {
            Log::error('Tugas dengan ID ' . $id . ' tidak ditemukan!');
            return redirect()->route('tugas.index')
                ->with('error', 'Tugas tidak ditemukan!');
        }

        // Cek apakah request dari dropdown status (hanya ada status, tanpa field lain)
        $requestData = $request->except(['_token', '_method']);
        Log::info('Request Data Count: ' . count($requestData));
        Log::info('Has Status: ' . ($request->has('status') ? 'YES' : 'NO'));

        if (count($requestData) === 1 && isset($requestData['status'])) {
            Log::info('>>> Masuk kondisi UPDATE STATUS ONLY');

            // Update hanya status (dari dropdown)
            try {
                $validated = $request->validate([
                    'status' => 'required|in:Belum Mulai,Berlangsung,Selesai',
                ]);

                Log::info('Validated Data: ', $validated);

                $tugas->update($validated);

                Log::info('Status berhasil diupdate ke: ' . $validated['status']);
                Log::info('Tugas Status Baru: ' . $tugas->fresh()->status);
                Log::info('=== UPDATE REQUEST END ===');

                return redirect()->route('tugas.index')
                    ->with('success', 'Status berhasil diupdate!');
            } catch (\Exception $e) {
                Log::error('Error saat update status: ' . $e->getMessage());
                return redirect()->route('tugas.index')
                    ->with('error', 'Gagal update status: ' . $e->getMessage());
            }
        }

        Log::info('>>> Masuk kondisi UPDATE FULL FORM');

        // Request dari form edit lengkap
        try {
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

            Log::info('Full form berhasil diupdate');
            Log::info('=== UPDATE REQUEST END ===');

            return redirect()->route('tugas.index')
                ->with('success', 'Tugas berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Error saat update full form: ' . $e->getMessage());
            return redirect()->route('tugas.index')
                ->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();

        return redirect()->route('tugas.index')
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

    public function beranda()
    {
        // Ambil tugas yang belum selesai (untuk list tugas aktif)
        $tugasAktif = Tugas::where('status', '!=', 'Selesai')
            ->orderBy('deadline', 'asc')
            ->limit(5)
            ->get();

        // Ambil tugas yang sudah selesai (untuk list tugas selesai)
        $tugasSelesai = Tugas::where('status', 'Selesai')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        // Hitung statistik
        $totalTugas = Tugas::count();
        $totalSelesai = Tugas::where('status', 'Selesai')->count();
        $totalAktif = $totalTugas - $totalSelesai;

        return view('beranda.index', compact('tugasAktif', 'tugasSelesai', 'totalTugas', 'totalSelesai', 'totalAktif'));
    }
}
