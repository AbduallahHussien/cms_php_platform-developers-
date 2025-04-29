<?php

namespace Botble\PluginUploader\Forms;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FormAbstract;
use Botble\PluginUploader\Http\Requests\PluginUploaderRequest;
use Botble\PluginUploader\Models\PluginUploader;

class PluginUploaderForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new PluginUploader())
            ->setValidatorClass(PluginUploaderRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'required' => true,
                'choices' => BaseStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}
