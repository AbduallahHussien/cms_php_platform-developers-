<?php

namespace Botble\Documentation\Forms;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FormAbstract;
use Botble\Documentation\Http\Requests\DocumentationRequest;
use Botble\Documentation\Models\Topic;

class TopicForm extends FormAbstract
{
    public function setup(): void
    {
        $documentationId = $this->getFormOption('documentation_id');

        $this
            ->setupModel(new Topic())
            ->setValidatorClass(DocumentationRequest::class)
            ->withCustomFields()
            ->add('documentation_id', 'hidden', [
                'value' => $documentationId,
            ])
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
