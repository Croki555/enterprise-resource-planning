$('.update-btn').on('click', (ev)=> $('.close-btn').click())
let update = document.getElementById('editProduct');
update.addEventListener('show.bs.modal', function (event) {
    let button = event.relatedTarget;
    let id = button.getAttribute('data-id-product')
    $('#editProduct').find('form').attr({
        'action': `http://127.0.0.1:8000/product/${id}`,
        'data-id-product': id
    }).trigger('reset').end().find('.attr-list').empty()
    $.ajax({
        url: `http://127.0.0.1:8000/product/${id}`,
        method: 'GET',
        contentType: 'json',
        success: function (data) {
            const modalTitle = $('#editProduct').find('.modal-title');
            const articleInput = $('#editProduct').find('#article');
            const titleInput = $('#editProduct').find('input[name="name"]');
            const statusSelect = $('#editProduct').find(`option[value=${data.status}]`);

            modalTitle.text(`Редактировать ${data.name}`);
            articleInput.val(data.article);
            titleInput.val(data.name);
            statusSelect.attr('selected', '')

            const attributes = JSON.parse(data.data);
            const attributeList = $('.attr-list');

            for (let item in attributes){
                attributeList.append(`
                    <li class="d-flex mb-2 gap-2 align-items-center justify-content-between" data-id-attr="${item}">
                        <div class="flex-grow-1">
                            <label for="dataTitle-0" class="form-label mb-1 text-white">Название</label>
                            <input type="text" id="dataTitle-0" name="title[]" class="form-control" value="${attributes[item].title}">
                        </div>
                        <div class="flex-grow-1">
                            <label for="dataValue-0" class="form-label mb-1 text-white">Значение</label>
                            <input type="text" id="dataValue-0" name="value[]" class="form-control" value="${attributes[item].value}">
                        </div>
                        <button class="basket align-self-end mb-1 bg-transparent" data-id-del="${item}"></button>
                    </li>
                `)
            }
        }
    })
})

update.addEventListener('hide.bs.modal', function (event) {
    $('#editProduct').find('.attr-list').empty().end()
        .find('form').trigger('reset').find('input').removeClass('is-invalid is-valid');
})

$(update).on('submit', function (ev) {
    ev.preventDefault();
    let attr = $('#editProduct').find('[name="title[]"]').map(function (idx, item) {
        if($(item).val().length > 0) {
            return {
                "title": $(item).val(),
                "value": $('#editProduct').find('[name="value[]"]').eq(idx).val()
            };
        }
    }).get();
    $.ajax({
        url: $(this).find('form').attr('action'),
        type: 'PUT',
        dataType: 'json',
        data: {
            '_token': $(this).find('[name = _token]').val(),
            '_method': $(this).find('[name = _method]').val(),
            'article': $(this).find('[name = article]').val(),
            'name': $(this).find('[name = name]').val(),
            'status': $(this).find('[name = status]').val(),
            'data': JSON.stringify(attr),
        },
        success: function (data) {
            const attributes = JSON.parse(data.data);
            const tr = $(`tr[data-id-product=${data.id}]`);
            const status = {
                'available': 'Доступен',
                'unavailable': 'Не доступен'
            }[data.status] || '';

            tr.find('td[data-article]').text(data.article);
            tr.find('td[data-name]').text(data.name);
            tr.find('td[data-status]').text(status);
            tr.find('td[data-attributes]').empty();

            for (let item in attributes) {
                $('<span>').addClass('d-block').text(attributes ? `${attributes[item].title}: ${attributes[item].value}` : '-').appendTo(tr.find('td:last'));
            }

            $('#editProduct').find('[data-bs-dismiss= modal]').click()
        },
        error: function (data) {
            const responseJSON = data.responseJSON;
            const articleMsg = responseJSON.article ?? '';
            const nameMsg = responseJSON.name ?? '';
            console.log(responseJSON)

            const editFormProduct = $('#editProduct');
            editFormProduct.find('[name=article]').removeClass('is-invalid is-valid').addClass(articleMsg ? 'is-invalid' : 'is-valid').next().text(articleMsg);
            editFormProduct.find('[name=name]').removeClass('is-invalid is-valid').addClass(nameMsg ? 'is-invalid' : 'is-valid').next().text(nameMsg);
        }
    })
})
