<?php

namespace Botble\Gift\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Gift\Enums\GiftStatusEnum;
use Botble\Gift\Forms\GiftForm;

use Botble\Gift\Http\Requests\GiftReplyRequest;
use Botble\Gift\Http\Requests\CertRequest;
use Botble\Gift\Models\Gift;
use Botble\Gift\Models\Cert;
use Botble\Gift\Models\GiftReply;
use Botble\Gift\Tables\GiftTable;
use Botble\Gift\Tables\CertTable;
use Botble\Gift\Forms\CertForm;
use Illuminate\Validation\ValidationException;

class CertController extends BaseController
{
    public function index(CertTable $dataTable)
    {
        $this->pageTitle(trans('plugins/gift::gift.cert'));

        return $dataTable->renderTable();
    }

   
    public function create()
    {
        $this->pageTitle(trans('plugins/gift::gift.cert_create'));

        return CertForm::create()->renderForm();
    }
    public function store(
        CertRequest $request,
    ) {

        $form = CertForm::create();
        $form
        ->saving(function (CertForm $form) use ($request) {
            $form
                ->getModel()
                ->fill([...$request->validated(),
                ])
                ->save();
        });

      

        return $this
            ->httpResponse()
            ->setPreviousRoute('certs.index')
            ->setNextRoute('certs.index')
            ->withCreatedSuccessMessage();
    }

   
    public function edit(Cert $cert)
    {
        $this->pageTitle(trans('plugins/gift::gift.edit-cert',['name' => $cert->name]));

        return CertForm::createFromModel($cert)->renderForm();
    }
    

    public function update(Cert $cert, CertRequest $request)
    {
        CertForm::createFromModel($cert)->setRequest($request)->save();

        return $this
            ->httpResponse()
            ->setPreviousRoute('certs.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Cert $cert)
    {
        return DeleteResourceAction::make($cert);
    }

    
}
