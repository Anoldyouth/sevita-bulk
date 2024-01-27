<?php

namespace App\Http\Support\Models;

use App\Enums\ImportStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Базовый класс для моделей импорта
 *
 * @property int $id
 * @property string $status Статус импорта
 * @property string $file Путь к файлу
 * @property int|null $chunks_count Количество запланированных чанков
 * @property int $chunks_finished Количество обработанных чанков
 * @property ?string $message - Текстовое поле под сообщение
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
abstract class BaseImportModel extends Model
{
    protected $fillable = ['status', 'file'];

    protected string $entityNameForMessage = '';

    protected $casts = [
        'status' => ImportStatusEnum::class,
    ];

    abstract public function errors(): HasMany;

    public function hasErrors(): bool
    {
        return $this->errors()->exists();
    }

    public function prepareMessage(): self
    {
        if ($this->status == ImportStatusEnum::DONE->label()) {
            $this->message = "Список {$this->entityNameForMessage} загружен успешно";

            return $this;
        }

        $this->message = $this->message ?? 'Произошла ошибка загрузки. Проверьте корректность данных в файле и попробуйте снова';

        return $this;
    }

    protected function getStatusAttribute()
    {
        return ImportStatusEnum::from($this->attributes['status'])->label();
    }
}
