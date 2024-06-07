<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketUmrahDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'paket_umrah_id',
        'kode_paket',
        'jenis_kamar',
        'harga_paket',
        'hotel_mekkah',
        'hotel_madinah',
    ];

    // Your existing relationship with PaketUmrah
    public function paketUmrah()
    {
        return $this->belongsTo(PaketUmrah::class, 'paket_umrah_id');
    }

    // Eloquent event to generate kode_paket before creating a new record.
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) \Str::uuid();
            // $model->kode_paket = 'KDPKT' . now()->timestamp;
        });
    }
}
