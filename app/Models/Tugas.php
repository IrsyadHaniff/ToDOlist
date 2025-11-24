<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'tugas';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'tanggal',
        'nama_matakuliah',
        'tugas',
        'deskripsi',
        'jenis',
        'deadline',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'tanggal' => 'date',
        'deadline' => 'date',
    ];

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan jenis
     */
    public function scopeJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }

    /**
     * Accessor untuk format tanggal Indonesia
     */
    public function getTanggalFormatAttribute()
    {
        return $this->tanggal->format('d/m/Y');
    }

    /**
     * Accessor untuk format deadline Indonesia
     */
    public function getDeadlineFormatAttribute()
    {
        return $this->deadline->format('d/m/Y');
    }

    /**
     * Check apakah tugas sudah lewat deadline
     */
    public function isOverdue()
    {
        return $this->deadline->isPast() && $this->status !== 'Selesai';
    }
}