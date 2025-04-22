<?php

namespace Botble\CustomerTickets\Http\Controllers;

use App\Http\Controllers\Controller;
use Botble\CustomerTickets\Http\Resources\CommentResource;
use Botble\CustomerTickets\Http\Resources\UpdateCommentResource;
use Botble\CustomerTickets\Models\Comment;
use Botble\CustomerTickets\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(private readonly CommentService $commentService)
    {}
    public function store(Request $request)
    {
        $comment = $this->commentService->createComment($request->all());

        return response()->json([
            'status'  => 'success',
            'comment' => new CommentResource($comment),
        ]);
    }

    public function update(Request $request, $id)
    {
        $comment = $this->commentService->updateComment($id,['text'=>$request->text]);

        return response()->json(new UpdateCommentResource($comment->refresh()));
    }

    public function destroy($id)
    {
       $this->commentService->deleteComment($id);

    }
}
