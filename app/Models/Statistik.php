<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Statistik
 *
 * @property-read \App\Models\Peninjauan|null $peninjauan
 * @method static \Database\Factories\StatistikFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Statistik newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistik newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistik query()
 * @mixin \Eloquent
 */
class Statistik extends Model
{
    use HasFactory;
    protected $table = "statistik";
    protected $primaryKey = "id_statistik";
    protected $fillble = [
        "id_peninjauan",
        "detail_statistik"
    ];
    public $timestamps = false;

    public function peninjauan()
    {
        return $this->belongsTo(Peninjauan::class, 'id_peninjauan');
    }
}
