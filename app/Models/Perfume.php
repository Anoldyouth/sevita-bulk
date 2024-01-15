<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id Код парфюма
 * @property string $name Название парфюма
 * @property int $price Цена парфюма (в копейках)
 * @property Carbon|null $created_at Метка времени создания
 * @property Carbon|null $updated_at Метка времени редактирования
 */
class Perfume extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'price',
    ];
}
