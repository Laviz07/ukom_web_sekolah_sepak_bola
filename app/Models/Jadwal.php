<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Jadwal
 *
 * @property int $id_jadwal
 * @property string $judul_kegiatan
 * @property string $tanggal_kegiatan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kegiatan> $kegiatan
 * @property-read int|null $kegiatan_count
 * @method static \Database\Factories\JadwalFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Jadwal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jadwal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jadwal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Jadwal whereIdJadwal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jadwal whereJudulKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jadwal whereTanggalKegiatan($value)
 * @mixin \Eloquent
 */
class Jadwal extends Model
{
    use HasFactory;
    protected $table = "jadwal";
    protected $primaryKey = "id_jadwal";
    protected $fillable = [
        "judul_kegiatan",
        "tanggal_kegiatan"
    ];
    public $timestamps = false;

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, "id_jadwal");
    }
}
