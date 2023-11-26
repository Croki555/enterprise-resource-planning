const deleteProduct = $('#deleteProduct');
deleteProduct.on('submit', function (ev) {
    ev.preventDefault();
    const action = deleteProduct.attr('action');
    const token = deleteProduct.find('[name=_token]').val();
    const method = deleteProduct.find('[name=_method]').val();

    $.ajax({
        url: action,
        method: 'delete',
        data: {
            '_token': token,
            '_method': method
        },
        success: (data) => {
            $(`tr[data-id-product=${data.id}]`).remove();
            $('.close-btn').click();
        }
    });
});
