<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Presensi
 *
 * @property int $id_presensi
 * @property string $hari_tanggal_hadir
 * @method static \Database\Factories\PresensiFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Presensi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Presensi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Presensi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Presensi whereHariTanggalHadir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presensi whereIdPresensi($value)
 * @mixin \Eloquent
 */
class Presensi extends Model
{
    use HasFactory;
    protected $table = "presensi";
    protected $primaryKey = "id_presensi";
    protected $fillable = [
        "id_kegiatan",
        "tanggal_presensi"
    ];
    public $timestamps = false;

    public function presensi_detail()
    {
        return $this->hasMany(Presensi_detail::class, "id_presensi_detail");
    }
}
