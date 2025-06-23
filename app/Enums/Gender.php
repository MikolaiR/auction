<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasLabel;

enum Gender: int implements HasLabel, HasAll
{
    case MALE = 0;
    case FEMALE = 1;
    case OTHER = 2;

    /**
     * Get the label for the enum value.
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::MALE => __('Male'),
            self::FEMALE => __('Female'),
            self::OTHER => __('Other'),
        };
    }

    /**
     * Get all labels.
     *
     * @return array
     */
    public static function all(): array
    {
        return [
            self::MALE,
            self::FEMALE,
            self::OTHER,
        ];
    }
}
