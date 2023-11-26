$(document).ready(function () {
    $('.attr-list').on('click', '.basket', function () {
        let id = $(this).data('id-del');
        $(`li[data-id-attr=${id}]`).remove();
        if(id === 0) {
            count = 0;
        }
    })

    let count = 0;
    $('.add-attr').on('click', function () {
        if($(this).parent().prev('.attr-list').hasClass('update-list') && $(this).parent().prev('.attr-list').children().length !== 0) {
            count = $(this).parent().prev('.attr-list').children().last().data('id-attr');
            count++;
            $('.attr-list').append(
                `<li class="d-flex mb-2 gap-2 align-items-center justify-content-between" data-id-attr="${count}">
                <div class="flex-grow-1">
                    <label for="dataTitle-${count}" class="form-label mb-1 text-white">Название</label>
                    <input type="text" id="dataTitle-${count}" name="title[]" class="form-control">
                </div>
                <div class="flex-grow-1">
                    <label for="dataValue-${count}" class="form-label mb-1 text-white">Значение</label>
                    <input type="text" id="dataValue-${count}" name="value[]" class="form-control">
                </div>
                <button class="basket align-self-end mb-1 bg-transparent" data-id-del="${count}">  </button>
            </li>`
            );
        } else {
            $('.attr-list').append(
                `<li class="d-flex mb-2 gap-2 align-items-center justify-content-between" data-id-attr="${count}">
                <div class="flex-grow-1">
                    <label for="dataTitle-${count}" class="form-label mb-1 text-white">Название</label>
                    <input type="text" id="dataTitle-${count}" name="title[]" class="form-control">
                </div>
                <div class="flex-grow-1">
                    <label for="dataValue-${count}" class="form-label mb-1 text-white">Значение</label>
                    <input type="text" id="dataValue-${count}" name="value[]" class="form-control">
                </div>
                <button class="basket align-self-end mb-1 bg-transparent" data-id-del="${count}">  </button>
            </li>`
            );
            count++;
        }
    })
    let edit = document.getElementById('editProduct');
    let add = document.getElementById('addProduct');

    let hideModal = function() {
        count = 0;
    };

    edit.addEventListener('hide.bs.modal', hideModal);
    add.addEventListener('hide.bs.modal', hideModal);
})
