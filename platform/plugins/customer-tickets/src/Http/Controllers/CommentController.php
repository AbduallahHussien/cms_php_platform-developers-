<?php

namespace Botble\CustomerTickets\Http\Controllers;

use App\Http\Controllers\Controller;
use Botble\CustomerTickets\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
{
    $comment = Comment::create([
        'ticket_id' => $request->input('ticket_id'),
        'user_id'   => auth()->id(),
        'text'      => $request->input('text'),
    ]);

    return response()->json([
        'status'  => 'success',
        'comment' => [
            'id'         => $comment->id,
            'text'       => $comment->text,
            'created_at' => $comment->created_at->format('Y-m-d H:i'),
        ],
    ]);
}

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $comment->update([
            'text' => $request->input('text'),
        ]);

        return response()->json([
            'id'         => $comment->id,
            'text'       => $comment->text,
            'created_at' => $comment->updated_at->format('Y-m-d H:i'),
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'status' => 'deleted',
        ]);
    }
}
