<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeTiket extends Model
{
    use HasFactory;

    protected $table = 'tipe_tikets';

    protected $fillable = [
        'nama',
        'keterangan',
    ];

    public function tikets()
    {
        return $this->hasMany(Tiket::class, 'tipe_tiket_id');
    }
}
