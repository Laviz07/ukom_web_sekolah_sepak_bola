<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Kegiatan
 *
 * @property int $id_kegiatan
 * @property string $tipe_kegiatan
 * @property string $jam_kegiatan
 * @property string|null $foto_kegiatan
 * @property string $detail_kegiatan
 * @property string $laporan_kegiatan
 * @property-read \App\Models\Jadwal|null $jadwal
 * @property-read \App\Models\Pelatih|null $pelatih
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presensi> $presensi
 * @property-read int|null $presensi_count
 * @method static \Database\Factories\KegiatanFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Kegiatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kegiatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kegiatan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kegiatan whereDetailKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kegiatan whereFotoKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kegiatan whereIdKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kegiatan whereJamKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kegiatan whereLaporanKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kegiatan whereTipeKegiatan($value)
 * @mixin \Eloquent
 */
class Kegiatan extends Model
{
    use HasFactory;
    protected $table = "kegiatan";
    protected $primaryKey = "id_kegiatan";
    protected $keyType = 'string';
    protected $fillable = [
        "id_kegiatan",
        "nama_kegiatan",
        "nik_pelatih",
        "jam_mulai",
        "jam_selesai",
        "tipe_kegiatan",
        "foto_kegiatan",
        "detail_kegiatan",
        "laporan_kegiatan",
        "id_jadwal",
    ];
    public $timestamps = false;

    public function pelatih(): BelongsTo
    {
        return $this->belongsTo(Pelatih::class, "nik_pelatih");
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, "id_jadwal");
    }

    public function presensi(): HasOne
    {
        return $this->hasOne(Presensi::class, "id_presensi");
    }
}
