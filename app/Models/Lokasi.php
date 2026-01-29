<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasis'; // or 'lokasi' if that’s your table name
    protected $fillable = ['nama_lokasi', 'aktif'];
    public $timestamps = true;

    public function scopeAktif($query)
    {
        return $query->where('aktif', 'Y');
    }
}