<?php

namespace Botble\Documentation\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Documentation\Http\Requests\DocumentationRequest;
use Botble\Documentation\Models\Documentation;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Documentation\Tables\DocumentationTable;
use Botble\Documentation\Forms\DocumentationForm;

class DocumentationController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans(trans('plugins/documentation::documentation.name')), route('documentation.index'));
    }

    public function index(DocumentationTable $table)
    { 
        $this->pageTitle(trans('plugins/documentation::documentation.name'));

        
        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/documentation::documentation.create'));

        return DocumentationForm::create()->renderForm();
    }

    public function store(DocumentationRequest $request)
    {
        $form = DocumentationForm::create()->setRequest($request);

        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('documentation.index'))
            ->setNextUrl(route('documentation.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Documentation $documentation)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $documentation->name]));

        return DocumentationForm::createFromModel($documentation)->renderForm();
    }

    public function update(Documentation $documentation, DocumentationRequest $request)
    {
        DocumentationForm::createFromModel($documentation)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('documentation.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Documentation $documentation)
    {
        return DeleteResourceAction::make($documentation);
    }
}
