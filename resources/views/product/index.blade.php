<x-app-layout title="Продукты">
    @section('content')
        <input hidden name="statusProducts" value="{{ $status }}">
        <div class="d-flex align-items-start justify-content-between">
            <table class="table align-middle" style="max-width: 630px">
                <thead>
                <tr class="text-uppercase text-secondary">
                    <th>Артикул</th>
                    <th>Название</th>
                    <th>Статус</th>
                    <th>Атрибуты</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr data-bs-toggle="modal" data-bs-target="#showProduct" data-id-product="{{ $product->id }}" data-product="{{ json_encode($product) }}">
                        <td data-article>{{ $product->article }}</td>
                        <td data-name>{{ $product->name }}</td>
                        <td data-status>{{ __("messages.$product->status") }}</td>
                        <td data-attributes>
                            @foreach(json_decode($product->data) as $data)
                                <span class="d-block">{{ $data->title }}: {{ $data->value }}</span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pt-3 me-3">
                <button class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#addProduct">Добавить</button>
            </div>
        </div>
        <!-- Модальное окно, добавить продукт -->
        <div class="modal fade" id="addProduct" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h3 class="modal-title text-white">Добавить продукт</h3>
                        <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal"
                                aria-label="Close">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.5 7.5L7.5 22.5" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M7.5 7.5L22.5 22.5" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('products.add') }}" method="post" novalidate>
                            @csrf
                            <div class="mb-2">
                                <label for="article" class="form-label mb-1 text-white">Артикул</label>
                                <input type="text" class="form-control" name="article" id="article">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label mb-1 text-white">Название</label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="mb-2">
                                <label for="status" class="form-label mb-1 text-white">Статус</label>
                                <select class="form-control status-select" name="status" id="status">
                                    <option selected value="available">Доступен</option>
                                    <option value="unavailable">Не доступен</option>
                                </select>
                            </div>
                            <h4 class="mb-3 text-white">Атрибуты</h4>
                            <ul class="attr-list add-list m-0 p-0" style="max-width: 470px"></ul>
                            <div class="mb-4">
                                <span class="d-inline-block add-attr">+ Добавить атрибут</span>
                            </div>
                            <input class="btn-blue" type="submit" value="Добавить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Модальное окно, информация о продукте -->
        <div class="modal fade" id="showProduct" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h3 class="modal-title text-white"></h3>
                        <div class="modal-buttons d-flex align-items-center">
                            <button class="update-btn me-1" data-bs-toggle="modal" data-bs-target="#editProduct"></button>
                            <form class="d-inline-flex me-3" action="#" method="post" id="deleteProduct">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="basket"></button>
                            </form>
                            <button type="button" class="close-btn bg-transparent" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        <!-- Модальное окно, редактировать продукт -->
        <div class="modal fade" id="editProduct" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h3 class="modal-title text-white">Редактировать</h3>
                        <button type="button" class="close-btn bg-transparent" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <label for="article" class="form-label mb-1 text-white">Артикул</label>
                                <input @if(!App\Http\Controllers\IsAdmin::isAdmin()) disabled @endif type="text" class="form-control" name="article" id="article">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label mb-1 text-white">Название</label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="mb-2">
                                <label for="status" class="form-label mb-1 text-white">Статус</label>
                                <select class="form-control status-select" name="status" id="status">
                                    <option value="available">Доступен</option>
                                    <option value="unavailable">Не доступен</option>
                                </select>
                            </div>
                            <h4 class="mb-3 text-white">Атрибуты</h4>
                            <ul class="attr-list edit-list m-0 p-0" style="max-width: 470px"></ul>
                            <div class="mb-4">
                                <span class="d-inline-block add-attr">+ Добавить атрибут</span>
                            </div>
                            <input class="btn-blue" type="submit" value="Сохранить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <x-slot name="scripts">
        @vite(['resources/js/other/addAttributes.js', 'resources/js/product/ajax/show.js','resources/js/product/delete.js', 'resources/js/product/add.js', 'resources/js/product/update.js'])
    </x-slot>
</x-app-layout>
