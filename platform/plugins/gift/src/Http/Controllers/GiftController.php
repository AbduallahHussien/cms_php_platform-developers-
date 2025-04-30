<?php

namespace Botble\Gift\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Gift\Enums\GiftStatusEnum;
use Botble\Gift\Forms\GiftForm;

use Botble\Gift\Http\Requests\GiftReplyRequest;
use Botble\Gift\Http\Requests\EditGiftRequest;
use Botble\Gift\Models\Gift;
use Botble\Gift\Models\Cert;
use Botble\Gift\Models\GiftReply;
use Botble\Gift\Tables\GiftTable;
use Botble\Gift\Tables\CertTable;
use Botble\Gift\Forms\CertForm;
use Illuminate\Validation\ValidationException;

class GiftController extends BaseController
{
    public function index(GiftTable $dataTable)
    {
        $this->pageTitle(trans('plugins/gift::gift.menu'));

        return $dataTable->renderTable();
    }
    
   
    
    public function edit(Gift $gift)
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/gift::gift.menu'), route('gifts.index'));

        $this->pageTitle(trans('plugins/gift::gift.edit'));

        return GiftForm::createFromModel($gift)->renderForm();
    }

    public function update(Gift $gift, EditGiftRequest $request)
    {
        GiftForm::createFromModel($gift)->setRequest($request)->save();

        return $this
            ->httpResponse()
            ->setPreviousRoute('gifts.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Gift $gift)
    {
        return DeleteResourceAction::make($gift);
    }

    public function postReply(Gift $gift, GiftReplyRequest $request)
    {
        $message = BaseHelper::clean($request->input('message'));

        if (! $message) {
            throw ValidationException::withMessages(['message' => trans('validation.required', ['attribute' => 'message'])]);
        }

        EmailHandler::send($message, sprintf('Re: %s', $gift->subject), $gift->email);

        GiftReply::query()->create([
            'message' => $message,
            'gift_id' => $gift->getKey(),
        ]);

        $gift->status = GiftStatusEnum::READ();
        $gift->save();

        return $this
            ->httpResponse()
            ->setMessage(trans('plugins/gift::gift.message_sent_success'));
    }
}
