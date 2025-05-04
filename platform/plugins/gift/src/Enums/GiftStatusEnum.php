<?php

namespace Botble\Gift\Enums;

use Botble\Base\Facades\Html;
use Botble\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

/**
 * @method static GiftStatusEnum UNREAD()
 * @method static GiftStatusEnum READ()
 */
class GiftStatusEnum extends Enum
{
    public const READ = 'read';

    public const UNREAD = 'unread';

    public static $langPath = 'plugins/gift::gift.statuses';

    public function toHtml(): HtmlString|string
    {
        return match ($this->value) {
            self::UNREAD => Html::tag('span', self::UNREAD()->label(), ['class' => 'badge bg-warning text-warning-fg']),
            self::READ => Html::tag('span', self::READ()->label(), ['class' => 'badge bg-success text-success-fg']),
            default => parent::toHtml(),
        };
    }
}
