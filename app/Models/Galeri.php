<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Galeri
 *
 * @property int $id_galeri
 * @property string $foto
 * @property string $keterangan_foto
 * @method static \Database\Factories\GaleriFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri query()
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereIdGaleri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereKeteranganFoto($value)
 * @mixin \Eloquent
 */
class Galeri extends Model
{
    use HasFactory;
    protected $table = "galeri";
    protected $primaryKey = "id_galeri";
    protected $keyType = 'string';
    protected $fillable = [
        "id_galeri",
        "keterangan_foto",
        "foto"
    ];
    public $timestamps = false;
}
