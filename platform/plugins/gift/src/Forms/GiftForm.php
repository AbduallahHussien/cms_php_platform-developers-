<?php

namespace Botble\Gift\Forms;

use Botble\Base\Facades\Assets;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\FormAbstract;
use Botble\Gift\Enums\GiftStatusEnum;
use Botble\Gift\Http\Requests\EditGiftRequest;
use Botble\Gift\Models\Gift;

class GiftForm extends FormAbstract
{
    public function setup(): void
    {
        Assets::addScriptsDirectly('vendor/core/plugins/gift/js/gift.js')
            ->addStylesDirectly('vendor/core/plugins/gift/css/gift.css');

        $this
            ->model(Gift::class)
            ->setValidatorClass(EditGiftRequest::class)
            ->add(
                'status',
                SelectField::class,
                StatusFieldOption::make()
                    ->choices(GiftStatusEnum::labels())
                    ->toArray()
            )
            ->setBreakFieldPoint('status')
            ->addMetaBoxes([
                'information' => [
                    'title' => trans('plugins/gift::gift.gift_information'),
                    'content' => view('plugins/gift::gift-info', ['gift' => $this->getModel()])->render(),
                ],
                'replies' => [
                    'title' => trans('plugins/gift::gift.replies'),
                    'content' => view('plugins/gift::reply-box', ['gift' => $this->getModel()])->render(),
                ],
            ]);
    }
}
