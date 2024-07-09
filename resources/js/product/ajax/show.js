let show = document.getElementById('showProduct');
const baseUrl = $('meta[name="baseUrl"]').attr('content');
show.addEventListener('show.bs.modal', function (event) {
    let button = event.relatedTarget;
    let id = button.getAttribute('data-id-product')
    $('#showProduct').find('form').attr({
        'action': `${baseUrl}/product/${id}`,
        'data-id-product': id
    })
    $('.update-btn').attr('data-id-product', id);
    $.ajax({
        url: `${baseUrl}/product/${id}`,
        method: 'GET',
        success: function (data) {
            const modalTitle = $('#showProduct').find('.modal-title');
            modalTitle.text(data.name);

            const status = {
                'available': 'Доступен',
                'unavailable': 'Не доступен'
            }[data.status] || '';

            const modalBody = $('#showProduct').find('.modal-body');
            modalBody.empty().html(`
                    <div class="d-flex gap-4">
                        <div class="d-flex flex-column gap-2">
                            <h4 class="m-0">Артикул</h4>
                            <h4 class="m-0">Название</h4>
                            <h4 class="m-0">Статус</h4>
                            <h4 class="m-0">Атрибуты</h4>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <span class="text-white">${data.article}</span>
                            <span class="m-0 text-white">${data.name}</span>
                            <span class="text-white">${status}</span>
                            <ul class="list-group" data-attr></ul>
                        </div>
                    </div>
                `);
            const attributeList = $('#showProduct').find('[data-attr]');
            attributeList.empty();

            const attributes = JSON.parse(data.data);
            for (let item in attributes) {
                attributeList.append(`
                        <li class="list-group">
                            <span class="text-white">${attributes[item].title}: ${attributes[item].value}</span>
                        </li>
                    `);
            }
        }
    })
})
