
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // فتح المودال للتعديل
    $(document).on('click', '.editCommentBtn', function () {
        let commentId = $(this).data('id');
        let text = $(this).data('text');

        $('#comment_id').val(commentId);
        $('#followUpText').val(text);
    });

    // فتح المودال للإضافة
    $('.fa-plus-circle').on('click', function () {
        $('#comment_id').val('');
        $('#followUpText').val('');
    });

    // إرسال Ajax للتعديل أو الإضافة
    $('#followUpForm').on('submit', function (e) {
        e.preventDefault();

        let commentId = $('#comment_id').val();
        let formData = $(this).serialize();
        let method = commentId ? 'PUT' : 'POST';
        let url = commentId ? `/admin/comments/${commentId}` : '{{ route('comments.store') }}';

        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function (res) {
                $('#followUpModal').modal('hide');
                $('#followUpForm')[0].reset();

                // تعديل أو إضافة الكومنت في الصفحة
                if (commentId) {
                    // تعديل موجود
                    let commentBox = $(`.comment-item[data-id="${res.id}"]`);
                    commentBox.find('.comment-text').text(res.text);
                    commentBox.find('.comment-date').text(res.created_at);
                } else {
                    // إضافة جديدة
                    $('#commentsList').append(renderComment(res.comment));
                    updateCommentsCount();
                }
            },
            error: function () {
                alert('Something went wrong!');
            }
        });
    });

    // حذف الكومنت
    $(document).on('click', '.deleteCommentBtn', function (e) {
        e.preventDefault();
        if (!confirm('Are you sure you want to delete this comment?')) return;

        let commentId = $(this).data('id');

        $.ajax({
            url: `/admin/comments/${commentId}`,
            method: 'DELETE',
            success: function () {
                $(`.comment-item[data-id="${commentId}"]`).remove();
                updateCommentsCount();
            },
            error: function () {
                alert('Failed to delete the comment.');
            }
        });
    });

    // دالة لتحديث عدد الكومنتات
    function updateCommentsCount() {
        let count = $('.comment-item').length;
        $('#commentsCount').text(count);
    }

    // دالة لإنشاء HTML للكومنت الجديد
    function renderComment(comment) {
        return `
            <div class="border rounded p-3 mb-2 w-50 comment-item" data-id="${comment.id}">
                <div class="d-flex justify-content-between flex-wrap">
                    <strong class="comment-text">${comment.text}</strong>
                    <span class="text-muted comment-date">${comment.created_at}</span>
                </div>
                <div class="mt-2">
                    <a href="#" class="text-warning me-2 editCommentBtn" data-id="${comment.id}"
                        data-text="${comment.text}" data-bs-toggle="modal"
                        data-bs-target="#followUpModal">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="text-danger deleteCommentBtn" data-id="${comment.id}">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>`;
    }
});
