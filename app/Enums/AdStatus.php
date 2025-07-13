<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasColor;
use App\Contracts\Types\HasLabel;

enum AdStatus: int implements HasLabel, HasAll, HasColor
{
    case PENDING = 0;
    case PUBLISHED = 1;
    case REJECTED = 2;
    case EXPIRED = 3;
    case ARCHIVED = 4;

    /**
     * Get label.
     * 
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('Pending'),
            self::PUBLISHED => __('Published'),
            self::REJECTED => __('Rejected'),
            self::EXPIRED => __('Expired'),
            self::ARCHIVED => __('Archived'),
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
            self::PENDING,
            self::PUBLISHED,
            self::REJECTED,
            self::EXPIRED,
            self::ARCHIVED,
        ];
    }

    /**
     * Get color.
     * 
     * @return string
     */
    public function color(): string
    {
        return match ($this) {
            self::PENDING => __('warning'),
            self::PUBLISHED => __('info'),
            self::REJECTED => __('danger'),
            self::EXPIRED => __('secondary'),
            self::ARCHIVED => __('dark'),
        };
    }
}