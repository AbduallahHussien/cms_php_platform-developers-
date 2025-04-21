@extends($layout ?? BaseHelper::getAdminMasterLayoutTemplate())
@section('content')
    <div class="px-4">
        <h4 class="mb-4">{{ __('Edit Ticket') }}</h4>

        {!! Form::model($ticket, ['route' => ['tickets.update', $ticket->id], 'method' => 'PUT']) !!}

        <div class="row">
            <div class="col-md-12">
                {{-- Ticket Information Card --}}
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="row align-items-center mb-3">
                            <label for="customer_id" class="col-sm-2 col-form-label">{{ __('Customer Name') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                {!! Form::select('customer_id', $customers, null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <label for="type" class="col-sm-2 col-form-label">{{ __('Type') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                {!! Form::select('type', \Botble\Base\Enums\TicketTypeEnum::labels(), null, [
                                    'class' => 'form-control',
                                    'required',
                                ]) !!}
                            </div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <label for="level" class="col-sm-2 col-form-label">{{ __('Priority') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                {!! Form::select('level', \Botble\Base\Enums\TicketLevelEnum::labels(), null, [
                                    'class' => 'form-control',
                                    'required',
                                ]) !!}
                            </div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <label for="status" class="col-sm-2 col-form-label">{{ __('Status') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                {!! Form::select('status', \Botble\Base\Enums\TicketStatusEnum::labels(), null, [
                                    'class' => 'form-control',
                                    'required',
                                ]) !!}
                            </div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'required']) !!}
                            </div>
                        </div>

                        {{-- Comments Section --}}
                        <div class="bg-light rounded p-3 d-flex justify-content-center align-items-center mb-3">
                            <h5 class="mb-0 text-dark fw-bold" style="font-size: 1.15rem;">
                                FOLLOW UPS: <span id="commentsCount">{{ $ticket->comments->count() }}</span>
                                <i class="fas fa-plus-circle text-primary ms-2" style="cursor: pointer;"
                                    data-bs-toggle="modal" data-bs-target="#followUpModal"></i>
                            </h5>
                        </div>

                        {{-- List of Comments --}}
                        <div id="commentsList">
                            @foreach ($ticket->comments as $comment)
                                @include('plugins/customer-tickets::partials.comment', ['comment' => $comment])
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
        </div>

        {!! Form::close() !!}
    </div>
    <!-- Follow Up Modal -->
    <div class="modal fade" id="followUpModal" tabindex="-1" aria-labelledby="followUpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="followUpForm">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <input type="hidden" id="comment_id" name="comment_id"> {{-- للتعديل --}}

                    <div class="modal-header">
                        <h5 class="modal-title" id="followUpModalLabel">Add / Edit Follow Up</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="followUpText" class="form-label">Follow Up Text</label>
                            <textarea class="form-control" id="followUpText" name="text" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.editCommentBtn', function () {
                let commentId = $(this).data('id');
                let text = $(this).data('text');

                $('#comment_id').val(commentId);
                $('#followUpText').val(text);
            });

            $('.fa-plus-circle').on('click', function () {
                $('#comment_id').val('');
                $('#followUpText').val('');
            });

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

                        if (commentId) {
                            let commentBox = $(`.comment-item[data-id="${res.id}"]`);
                            commentBox.find('.comment-text').text(res.text);
                            commentBox.find('.comment-date').text(res.created_at);
                        } else {
                            $('#commentsList').append(renderComment(res.comment));
                            updateCommentsCount();
                        }
                    },
                    error: function () {
                        alert('Something went wrong!');
                    }
                });
            });

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

            function updateCommentsCount() {
                let count = $('.comment-item').length;
                $('#commentsCount').text(count);
            }

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
    </script>

@endsection
