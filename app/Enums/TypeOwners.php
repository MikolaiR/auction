<?php

namespace App\Enums;

enum TypeOwners: int
{

    case INDIVIDUAL = 0;
    case COMMERCE = 1;
    case ORGANIZATION = 3;

    public function label()
    {
        return match ($this) {
            self::INDIVIDUAL => __('Individual'),
            self::COMMERCE => __('Commerce'),
            self::ORGANIZATION => __('Organization'),
        };
    }

    public static function toArray(): array
    {
        return [
            self::INDIVIDUAL,
            self::COMMERCE,
            self::ORGANIZATION,
        ];
    }
}
