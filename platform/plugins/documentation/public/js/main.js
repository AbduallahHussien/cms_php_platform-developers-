class DocumentationPluginManagement {
    init() {
        $(document).on('click', '.increase_order, .decrease_order', function () {
            let container = $(this).closest('.order-controls');
            let itemId = container.data('id');
            let orderValueEle = container.find('.order-value');
            let decreaseBtn = container.find('.decrease_order');
            let increaseBtn = container.find('.increase_order');
            let updateOrderUrl = container.data('url');
            let currentValue = parseInt(orderValueEle.text());

            let newOrderValue = currentValue;
            if($(this).hasClass('increase_order'))
            {
                 newOrderValue = currentValue + 1;
            }
            else  
            {
                if(currentValue != 0)
                {
                    newOrderValue = currentValue - 1;
                }
                else 
                {
                    return;
                    // newOrderValue = 0;
                }
            }
            // let newOrderValue = $(this).hasClass('increase_order') ? currentValue + 1 : currentValue - 1;

            // 👇 Disable buttons and show spinner
            decreaseBtn.prop('disabled', true);
            increaseBtn.prop('disabled', true);
            orderValueEle.html('<span class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>');

            $.ajax({
                url: updateOrderUrl,
                method: 'POST',
                data: {
                    id: itemId,
                    order: newOrderValue,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    orderValueEle.text(newOrderValue);
                    toastr.success('Updated successfully');
                },
                error: function (xhr, status, error) {
                    let errorMessage = 'An error occurred.';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }

                    toastr.error('Error: ' + errorMessage);

                    // Restore the original value if needed
                    orderValueEle.text(currentValue);
                },
                complete: function () {
                    // 👇 Re-enable buttons after AJAX completes
                    decreaseBtn.prop('disabled', false);
                    increaseBtn.prop('disabled', false);
                }
            });
        });
    }
}
$(() => {
    new DocumentationPluginManagement().init();
});
