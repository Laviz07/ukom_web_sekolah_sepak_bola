<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\logs
 *
 * @property int $id_log
 * @property string $username
 * @property string $action
 * @property string $log
 * @property string $created_at
 * @method static \Database\Factories\logsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|logs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|logs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|logs query()
 * @method static \Illuminate\Database\Eloquent\Builder|logs whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|logs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|logs whereIdLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|logs whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|logs whereUsername($value)
 * @mixin \Eloquent
 */
class Logs extends Model
{
    use HasFactory;
    protected $table = "logs";
    protected $primaryKey = "id_log";
    protected $fillable = ['logs'];
    protected $guarded = ['id'];
    public $timestamps = false;
}
