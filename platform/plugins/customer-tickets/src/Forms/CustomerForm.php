<?php

namespace Botble\CustomerTickets\Forms;

use Botble\CustomerTickets\Base\Enums\CustomerStatusEnum;
use Botble\Base\Forms\FormAbstract;
use Botble\CustomerTickets\Http\Requests\CustomerRequest;
use Botble\CustomerTickets\Models\Customer;
use Botble\Base\Facades\Assets;

class CustomerForm extends FormAbstract
{
    // public function get_country_codes()
    // {
    //     return [
    //         '966' => '+966 (Saudi Arabia)',
    //         '20'  => '+20 (Egypt)',
    //         '971' => '+971 (UAE)',
    //         '965' => '+965 (Kuwait)',
    //         '962' => '+962 (Jordan)',
    //         '970' => '+970 (Palestine)',
    //         '1'   => '+1 (USA)',
    //         '44'  => '+44 (UK)',
    //         '49'  => '+49 (Germany)',
    //         '33'  => '+33 (France)',
    //         '90'  => '+90 (Turkey)',
    //     ];
    // }
    public function get_nationalities()
    {
        return [
            'Saudi'       => 'Saudi',
            'Egyptian'    => 'Egyptian',
            'Emirati'     => 'Emirati',
            'Kuwaiti'     => 'Kuwaiti',
            'Jordanian'   => 'Jordanian',
            'Palestinian' => 'Palestinian',
            'Syrian'      => 'Syrian',
            'Lebanese'    => 'Lebanese',
            'American'    => 'American',
            'British'     => 'British',
            'German'      => 'German',
            'French'      => 'French',
            'Turkish'     => 'Turkish',
        ];
    }
    
    public function setup(): void
    {
        Assets::addStylesDirectly('https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css');
        Assets::addScriptsDirectly('https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js');
        Assets::addScriptsDirectly('https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js');
        Assets::addScriptsDirectly('vendor/core/plugins/customer-tickets/js/main.js');
        $this
            ->setupModel(new Customer())
            ->setValidatorClass(CustomerRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('phone_group', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('country_code', 'html', [
                'html' => view('plugins/customer-tickets::components.country-codes-selectbox',['customer' => $this->model])->render(),
                'wrapper' => [
                    'class' => '',
                ],
            ])
            // ->add('phone_code', 'customSelect', [
            //     'label' => __('Country Code'),
            //     'required' => true,
            //     'choices' => $this->get_country_codes(),
            //     'wrapper' => [
            //         'class' => 'form-group col-md-3',
            //     ],
            // ])
            // ->add('phone', 'text', [
            //     'label' => __('Phone Number'),
            //     'required' => true,
            //     'attr' => [
            //         'placeholder' => __('Enter your number'),
            //         'data-counter' => 20,
            //     ],
            //     'wrapper' => [
            //         'class' => 'form-group col-md-9',
            //     ],
            // ])
            ->add('close_row', 'html', [
                'html' => '</div>',
            ])
            ->add('email', 'email', [
                'label' => __('Email Address'),
                'attr' => [
                    'placeholder' => __('example@email.com'),
                    'data-counter' => 120,
                ],
            ])
            ->add('nationality', 'customSelect', [
                'label' => __('Nationality'),
                'choices' =>$this->get_nationalities(),
                'attr' => [
                    'placeholder' => __('Select nationality'),
                ],
            ])
            ->add('gender', 'customSelect', [
                'label' => __('Gender'),
                'required' => true,
                'choices' => [
                    'male' => 'Male',
                    'female' => 'Female',
                ],
            ])
            ->add('notes', 'textarea', [
                'label' => __('Notes'),
                'attr' => [
                    'rows' => 4,
                    'placeholder' => __('Enter customer notes here...'),
                ],
            ]);

        if ($this->getModel()->id) {
            $this->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'choices' => CustomerStatusEnum::labels(),
            ]);
        }

        $this->setBreakFieldPoint('notes');
    }
}
