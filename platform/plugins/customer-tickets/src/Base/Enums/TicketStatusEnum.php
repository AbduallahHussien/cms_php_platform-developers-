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
class TicketStatusEnum extends Enum
{
    public const OPEN = 'open';
    public const IN_PROGRESS = 'in_progress';
    public const ANSWERED = 'answered';
    public const PENDING = 'pending';
    public const CLOSED = 'closed';

    public static $langPath = 'core/base::enums.statuses';

    public function toHtml(): string|HtmlString
    {
        return match ($this->value) {
            self::OPEN => Html::tag('span', self::OPEN(), ['class' => 'badge bg-warning text-warning-fg']),
            self::ANSWERED => Html::tag('span', self::ANSWERED(), ['class' => 'badge bg-success text-success-fg']),
            self::PENDING => Html::tag('span', self::PENDING(), ['class' => 'badge bg-secondary text-secondary-fg']),
            self::CLOSED => Html::tag('span', self::CLOSED(), ['class' => 'badge bg-dark text-dark-fg']),
            self::IN_PROGRESS => Html::tag('span', self::IN_PROGRESS(), ['class' => 'badge bg-primary text-primary-fg']),


            default => parent::toHtml(),
        };
    }
}
