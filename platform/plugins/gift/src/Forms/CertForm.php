<?php

namespace Botble\Gift\Forms;

use Botble\Base\Facades\Assets;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\ColorField;

use Botble\Base\Forms\FormAbstract;
use Botble\Gift\Enums\GiftStatusEnum;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Gift\Http\Requests\CertRequest;
use Botble\Gift\Models\Cert;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\ColorFieldOption;

use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\NumberField;

class CertForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(Cert::class)
            ->setValidatorClass(CertRequest::class)
            ->hasTabs()
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('image', MediaImageField::class)
            ->add('font_size', TextField::class)
            ->add('font_color', ColorField::class)
            ->add('from_x', NumberField::class)
            ->add('from_y', NumberField::class)
            ->add('to_x', NumberField::class)
            ->add('to_y', NumberField::class)
            ->setBreakFieldPoint('status');
    }
}
