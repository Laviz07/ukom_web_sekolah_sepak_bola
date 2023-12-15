<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Berita
 *
 * @property int $id_berita
 * @property string $judul_berita
 * @property string|null $foto_berita
 * @property string|null $isi_berita
 * @method static \Database\Factories\BeritaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Berita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita query()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereFotoBerita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereIdBerita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereIsiBerita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereJudulBerita($value)
 * @property-read \App\Models\Admin|null $admin
 * @mixin \Eloquent
 */
class Berita extends Model
{
    use HasFactory;
    protected $table = "berita";
    protected $primaryKey = "id_berita";
    protected $keyType = 'string';
    protected $fillable = [
        "id_berita",
        "judul_berita",
        "isi_berita",
        "foto_berita",
        "nik_admin",
    ];
    public $timestamps = false;

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'nik_admin');
    }
}
