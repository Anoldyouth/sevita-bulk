<?php

namespace App\Http\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Базовый класс для моделей ошибок импорта
 *
 * @property int $id
 * @property int $import_id ID импорта
 * @property int $row_num Номер строки в файле
 * @property string $message Сообщение
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
abstract class BaseImportErrorModel extends Model
{
}
