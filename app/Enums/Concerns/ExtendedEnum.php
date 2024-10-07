<?php

namespace App\Enums\Concerns;

trait ExtendedEnum
{
    public static function asOptions(): array
    {
        return array_map(function ($case) {
            return [
                'value' => $case->value,
                'label' => $case->description(),
            ];
        }, self::cases());
    }

    public function description(): string
    {
        return __($this->value);
    }
}
