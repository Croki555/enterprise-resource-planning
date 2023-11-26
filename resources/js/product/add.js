$('button[data-bs-target="#addProduct"]').click(function() {
    $('#addProduct').find('.attr-list').empty().end()
        .find('form').trigger('reset').find('input').removeClass('is-invalid is-valid');
});
$('#addProduct').on('submit', function (ev) {
    ev.preventDefault();
    let attr = $('#addProduct').find('[name="title[]"]').map(function (idx, item) {
        if($(item).val().length > 0) {
            return {
                "title": $(item).val(),
                "value": $('#addProduct').find('[name="value[]"]').eq(idx).val()
            };
        }
    }).get();
    $.ajax({
        url: $(this).find('form').attr('action'),
        method: 'post',
        dataType: 'json',
        data: {
            '_token': $(this).find('[name = _token]').val(),
            'article': $(this).find('[name = article]').val(),
            'name': $(this).find('[name = name]').val(),
            'status': $(this).find('[name = status]').val(),
            'data': JSON.stringify(attr),
        },
        success: function (data) {
            const table = $('table');
            const attributes = JSON.parse(data.data);
            const status = {
                'available': 'Доступен',
                'unavailable': 'Не доступен'
            }[data.status] || '';
            if($('[name=statusProducts]').val() === 'available' &&  data.status === 'available') {
                const row = $('<tr>').attr({
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#showProduct',
                    'data-id-product': data.id,
                    'data-product': JSON.stringify(data),
                }).appendTo(table);

                $('<td>').attr('data-article', '').text(data.article).appendTo(row);
                $('<td>').attr('data-name', '').text(data.name).appendTo(row);
                $('<td>').attr('data-status', '').text(status).appendTo(row);
                $('<td>').attr('data-attributes', '').appendTo(row);

                for (let item in attributes) {
                    $('<span>').addClass('d-block').text(attributes ? `${attributes[item].title}: ${attributes[item].value}` : '-').appendTo(row.find('td:last'));
                }
            }
            $('#addProduct').find('[data-bs-dismiss= modal]').click()
        },
        error: function (data) {
            const responseJSON = data.responseJSON;
            const articleMsg = responseJSON?.article ?? '';
            const nameMsg = responseJSON?.name ?? '';

            const addProductForm = $('#addProduct');
            addProductForm.find('[name=article]').removeClass('is-invalid is-valid').addClass(articleMsg ? 'is-invalid' : 'is-valid').next().text(articleMsg);
            addProductForm.find('[name=name]').removeClass('is-invalid is-valid').addClass(nameMsg ? 'is-invalid' : 'is-valid').next().text(nameMsg);
        }
    })
})

let add = document.getElementById('addProduct');
add.addEventListener('hide.bs.modal', function (event) {
    $('#addProduct').find('.attr-list').empty().end()
        .find('form').trigger('reset').find('input').removeClass('is-invalid is-valid');
})
