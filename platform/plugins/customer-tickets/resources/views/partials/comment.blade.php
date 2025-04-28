<div class="border rounded p-3 mb-2 w-50 comment-item" data-id="{{ $comment->id }}">
    <div class="d-flex justify-content-between flex-wrap">
        <strong class="comment-text">{{ $comment->text }}</strong>
        <span class="text-muted comment-date">{{ $comment->created_at->format('Y-m-d H:i') }}</span>
    </div>
    <div class="mt-2">
        <a href="#" class="text-warning me-2 editCommentBtn" data-id="{{ $comment->id }}"
            data-text="{{ $comment->text }}" data-bs-toggle="modal"
            data-bs-target="#followUpModal">
            <i class="fas fa-edit"></i>
        </a>
        <a href="#" class="text-danger deleteCommentBtn" data-id="{{ $comment->id }}">
            <i class="fas fa-trash"></i>
        </a>
    </div>
</div>
