<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jamaah extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'no_ktp',
        'nama_lengkap',
        'jenis_kelamin',
        'status_pernikahan',
        'nama_foto',
        'tempat_lahir',
        'tanggal_lahir',
        'usia',
        'kewarganegaraan',
        'golongan_darah',
        'nama_relasi',
        'role_relasi',
        'alamat_lengkap',
        'alamat_lengkap2',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'rw',
        'rt',
        'kodepos',
        'no_telp',
        'email',
        'nama_sekolah',
        'alamat_sekolah',
        'pendidikan',
        'tempat_kerja',
        'nama_bagian',
        'profesi',
        'members',
        'is_register',
        'is_deleted',];

    // protected $primaryKey = 'id';
    public $incrementing = false;

    public function updateRelasiName($roleRelasi)
    {
        if ($roleRelasi != '') {
            $this->update(['nama_relasi' => $roleRelasi]); // Update with your condition
        } else {
            $this->update(['nama_relasi' => '']); // Update with your condition
        }
        // Add more conditions as needed
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) \Str::uuid();
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function parentRecursive(): BelongsTo
    {
        return $this->parent()->with('parentRecursive');
    }

    public function parentRecursiveFlatten()
    {
        $result = collect();
        $item = $this->parentRecursive;
        if ($item instanceof Jamaah) {
            $result->push($item);
            $result = $result->merge($item->parentRecursiveFlatten());
        }
        return $result;
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }
}
