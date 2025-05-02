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
class TicketTypeEnum extends Enum
{
    public const INQUIRY = 'inquiry';
    public const COMPLAINT = 'complaint';
    public const SUGGESTION = 'suggestion';
    public const OTHER = 'other';

    public static $langPath = 'core/base::enums.statuses';

    public function toHtml(): string|HtmlString
    {
        return match ($this->value) {
            self::INQUIRY => Html::tag('span', self::INQUIRY(), ['class' => 'badge bg-warning text-warning-fg']),
            self::COMPLAINT => Html::tag('span', self::COMPLAINT(), ['class' => 'badge bg-success text-success-fg']),
            self::SUGGESTION => Html::tag('span', self::SUGGESTION(), ['class' => 'badge bg-secondary text-secondary-fg']),
            self::OTHER => Html::tag('span', self::OTHER(), ['class' => 'badge bg-dark text-dark-fg']),


            default => parent::toHtml(),
        };
    }
}
