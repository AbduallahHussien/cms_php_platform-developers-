<?php

namespace Botble\CustomerTickets\Services;

use Botble\CustomerTickets\Models\Comment;

class CommentService
{

    public function getComment($id): Comment
    {
        return Comment::where('id', $id)->first();
    }
    public function createComment(array $data): Comment
    {
        return Comment::create($data);
    }
    public function updateComment($id, array $data): Comment
    {
        $comment = $this->getComment($id);
        $comment->update(['text' => $data['text']]);
        return $comment->refresh();
    }

    public function deleteComment($id): void
    {
        $this->getComment($id)->delete();
    }
}
