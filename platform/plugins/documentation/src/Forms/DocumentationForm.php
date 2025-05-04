<?php

namespace Botble\Documentation\Forms;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FormAbstract;
use Botble\Documentation\Http\Requests\DocumentationRequest;
use Botble\Documentation\Models\Documentation;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;

class DocumentationForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new Documentation())
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
            ->add('link', 'text', [
                'label' => trans('plugins/documentation::documentation.link'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('plugins/documentation::documentation.link_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add(
                'direction', 
                SelectField::class, 
                SelectFieldOption::make()
                    ->label(trans('plugins/documentation::documentation.direction'))
                    ->choices([
                        'LTR' => trans('plugins/documentation::documentation.ltr'),
                        'RTL' => trans('plugins/documentation::documentation.rtl'),
                    ]) 
                    ->selected($this->model ? $this->model->direction : 1) // Default selected value
                    ->required() // Add class "required" if that is mandatory field 
            )
            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'required' => true,
                'choices' => BaseStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}
