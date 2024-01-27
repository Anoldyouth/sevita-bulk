<?php

namespace App\Enums;

enum ImportStatusEnum: int
{
    case NEW = 1;
    case IN_PROCESS = 2;
    case DONE = 3;
    case FAILED = 4;

    public function label(): string
    {
        return match ($this) {
            self::NEW => "Создан",
            self::IN_PROCESS => "В процессе",
            self::DONE => "Завершен",
            self::FAILED => "Ошибка импорта",
        };
    }
}
