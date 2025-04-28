$(document).ready(function () {
    $(document).on('click', '.change-status-action', function (event) {
        event.preventDefault();

        const button = $(this);
        const customerId = button.closest('.table-actions').data('id') ||
                          button.closest('tr').data('id') ||
                          button.data('id');

        $.ajax({
            url: route('customer.status', { id: customerId }),
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                button.addClass('button-loading');
            },
            success: function (response) {
                if (response.success) {
                    Botble.showSuccess(response.message);

                    // Reload table to reflect the new status
                    $('.table').DataTable().ajax.reload();
                } else {
                    Botble.showError(response.message || 'Error changing status');
                }
            },
            error: function (error) {
                Botble.handleError(error);
            },
            complete: function () {
                button.removeClass('button-loading');
            }
        });
    });
});
