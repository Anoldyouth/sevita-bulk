<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id Код парфюма
 * @property string $name Название
 * @property float $price Цена (в копейках)
 * @property Carbon|null $created_at Метка времени создания
 * @property Carbon|null $updated_at Метка времени редактирования
 */
class Perfume extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'price',
    ];

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (?int $value) => $value / 100,
            set: fn (?float $value) => intval($value * 100),
        );
    }
}
