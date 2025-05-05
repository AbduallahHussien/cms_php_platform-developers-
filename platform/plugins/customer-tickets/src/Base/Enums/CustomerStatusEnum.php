<?php

namespace Botble\CustomerTickets\Base\Enums;

use Botble\Base\Facades\Html;
use Botble\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

/**
 * @method static BaseStatusEnum DRAFT()
 * @method static BaseStatusEnum PUBLISHED()
 * @method static BaseStatusEnum PENDING()
 */
class CustomerStatusEnum extends Enum
{
    public const ACTIVE = 'active';
    public const IN_ACTIVE = 'in_active';

    public static $langPath = 'core/base::enums.test';

    public function toHtml(): string|HtmlString
    {
        return match ($this->value) {
            self::ACTIVE => Html::tag('span', $this->getLabel(self::ACTIVE), ['class' => 'badge bg-success text-success-fg']),
            self::IN_ACTIVE => Html::tag('span', $this->getLabel(self::IN_ACTIVE), ['class' => 'badge bg-warning text-warning-fg']),

            default => parent::toHtml(),
        };
    }
    public static function getLabel(?string $value): ?string
{
    return match ($value) {
        self::ACTIVE => 'Active',
        self::IN_ACTIVE => 'Not Active',
        default => $value,
    };
}
}
