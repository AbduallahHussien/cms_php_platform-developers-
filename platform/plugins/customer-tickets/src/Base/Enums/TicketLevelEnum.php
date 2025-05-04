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
class TicketLevelEnum extends Enum
{
    public const HIGH = 'high';
    public const MEDIUM = 'medium';
    public const LOW = 'low';

    public static $langPath = 'core/base::enums.statuses';

    public function toHtml(): string|HtmlString
    {
        return match ($this->value) {
            self::HIGH => Html::tag('span', self::HIGH(), ['class' => 'badge bg-warning text-warning-fg']),
            self::MEDIUM => Html::tag('span', self::MEDIUM(), ['class' => 'badge bg-success text-success-fg']),
            self::LOW => Html::tag('span', self::LOW(), ['class' => 'badge bg-secondary text-secondary-fg']),


            default => parent::toHtml(),
        };
    }
}
