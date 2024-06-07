<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketUmrah extends Model
{
    use HasFactory;

    protected $casts = [
        'updated_at' => 'datetime',
    ];

    protected $guarded = ['id'];

    public $incrementing = false;

    protected $fillable = [
        'kode_paket',
        'nama_paket',
        'gambar',
        'pajak_bandara',
        'bus_bandara',
        'pembimbing',
        'contact_person',
        'tanggal_keberangkatan',
        'tanggal_akhir_pendaftaran',
        'paket_tersedia',
        'total_hari',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) \Str::uuid();
            $model->kode_paket = $model->kode_paket ?? 'KDPKT' . now()->timestamp;
            $model->deskripsi = $model->deskripsi ?? 'Deskripsi Paket Umrah';
        });
    }

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('assets/paket-umrah/' . $this->gambar) : null;
    }

    public function setGambarAttribute($value)
    {
        if ($value) {
            $imageName = 'KDPKT' . now()->timestamp . '.' . $value->getClientOriginalExtension();
            $value->storeAs('public/assets/paket-umrah', $imageName);
            $this->attributes['gambar'] = $imageName;
        }
    }

    // PaketUmrah model
    public function paketUmrahDetails()
    {
        return $this->hasMany(PaketUmrahDetail::class, 'paket_umrah_id');
    }
}
