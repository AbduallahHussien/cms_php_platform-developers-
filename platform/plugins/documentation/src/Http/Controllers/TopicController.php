<?php

namespace Botble\Documentation\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Documentation\Http\Requests\DocumentationRequest;
use Botble\Documentation\Models\Documentation;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Documentation\Tables\TopicTable;
use Botble\Documentation\Forms\TopicForm;

class TopicController extends BaseController
{
    public function __construct()
    {
        // $this
        //     ->breadcrumb()
        //     ->add(trans(trans('plugins/documentation::documentation.name')), route('documentation.index'));
    }

    // public function index(TopicTable $table)
    public function index(Documentation $documentation,TopicTable $table)
    {
        $this->pageTitle(trans('plugins/documentation::topic.name'));

         // Pass documentation to the table
        // $table->setDocumentation($documentation);

        return $table->renderTable();
    }

    public function create(Documentation $documentation)
    {
        $this->pageTitle(trans('plugins/documentation::documentation.create'));

        return TopicForm::create()->renderForm();
    }

    
}
