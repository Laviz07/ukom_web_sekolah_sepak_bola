<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Tim
 *
 * @property int $id_tim
 * @property int $nisn_pemain
 * @property string $nama_tim
 * @property string|null $deskripsi_tim
 * @property string|null $foto_tim
 * @property-read \App\Models\Pelatih|null $pelatih
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pemain> $pemain
 * @property-read int|null $pemain_count
 * @method static \Database\Factories\TimFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tim whereDeskripsiTim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tim whereFotoTim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tim whereIdTim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tim whereNamaTim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tim whereNisnPemain($value)
 * @mixin \Eloquent
 */
class Tim extends Model
{
  use HasFactory;
  protected $table = "tim";
  protected $primaryKey = "id_tim";
  protected $keyType = 'string';
  protected $fillable = [
    "nik_pelatih",
    "id_tim",
    "nama_tim",
    "deskripsi_tim",
    "foto_tim"
  ];
  public $timestamps = false;

  public function pelatih(): BelongsTo
  {
    return $this->belongsTo(Pelatih::class, "nik_pelatih");
  }

  public function pemain(): HasMany
  {
    return $this->hasMany(Pemain::class, "id_tim");
  }

  public function getPemainCountAttribute()
  {
    return $this->pemain()->count();
  }
}
