<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcms/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

namespace LarabizCMS\Modules\Blog\Models\Enums;

enum PostStatus: string
{
    case PUBLISHED = 'published';
    case DRAFT = 'draft';
    case PENDING = 'pending';

    public static function all(): array
    {
        return [
            self::PUBLISHED,
            self::DRAFT,
            self::PENDING
        ];
    }

    public static function options(): array
    {
        return [
            self::PUBLISHED->value => __('Published'),
            self::DRAFT->value => __('Draft'),
            self::PENDING->value => __('Pending'),
        ];
    }

    public function value(): string
    {
        return match ($this) {
            self::PUBLISHED => 'published',
            self::DRAFT => 'draft',
            self::PENDING => 'pending',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::PUBLISHED => __('Published'),
            self::DRAFT => __('Draft'),
            self::PENDING => __('Pending'),
        };
    }
}
