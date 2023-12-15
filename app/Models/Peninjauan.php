<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Peninjauan
 *
 * @property int $id_peninjauan
 * @property string $tanggal_peninjauan
 * @property string $evaluasi
 * @property int $nilai
 * @property-read \App\Models\Kegiatan|null $kegiatan
 * @property-read \App\Models\Pelatih|null $pelatih
 * @property-read \App\Models\Pemain|null $pemain
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Statistik> $statistik
 * @property-read int|null $statistik_count
 * @method static \Database\Factories\PeninjauanFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Peninjauan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Peninjauan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Peninjauan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Peninjauan whereEvaluasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peninjauan whereIdPeninjauan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peninjauan whereNilai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peninjauan whereTanggalPeninjauan($value)
 * @mixin \Eloquent
 */
class Peninjauan extends Model
{
    use HasFactory;
    protected $table = "peninjauan";
    protected $primaryKey = "id_peninjauan";
    protected $fillable = [
        "nisn_pemain",
        "nik_pelatih",
        "id_kegiatan",
        "tanggal_peninjauan",
        "evaluasi",
        "nilai"
    ];
    public $timestamps = false;

    public function pemain()
    {
        return $this->belongsTo(Pemain::class, "nisn_pemain");
    }

    public function pelatih()
    {
        return $this->belongsTo(Pelatih::class, "nik_pelatih");
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, "id_kegiatan");
    }

    public function statistik()
    {
        return $this->hasMany(Statistik::class, "id_statistik");
    }
}
