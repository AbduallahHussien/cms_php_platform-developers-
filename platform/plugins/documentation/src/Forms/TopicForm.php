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
        $this
            ->setupModel(new Topic())
            ->setValidatorClass(DocumentationRequest::class)
            ->withCustomFields() 
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ]) 
            ->add('documentation_id', 'hidden', [ 
                'required' => true
            ]) 
            ->add('order', 'hidden', [ 
                'required' => true
            ]) 
            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'required' => true,
                'choices' => BaseStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}
