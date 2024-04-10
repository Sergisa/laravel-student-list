@extends('layout')
@section('title', 'Список пользователей')
@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8 text-blue-600">
        <button id="add-user"
                class="btn bg-red-400 mb-3 hover:bg-red-600 px-5 py-2.5 text-sm leading-5 rounded-md font-semibold text-white">
            Добавить пользователя
            <x-heroicon-m-plus/>
        </button>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 lg:gap-3">
            @foreach ($users as $user)
                <x-card link="laravel.com" class="user-card" id="{{ $user->id }}">
                    <x-slot:title>{{ $user->name }}</x-slot:title>
                    {{ $user->description }}<br>
                    <b>
                        {{ $user->group->name }}
                    </b>
                    <div class="top-right-corner tools">
                        <button class="btn bg-blue-500 hover:bg-blue-400 text-white delete-button">
                            <x-heroicon-o-trash/>
                        </button>
                        <button class="btn bg-green-500 hover:bg-green-400 text-white edit-button">
                            <x-heroicon-o-pencil-square/>
                        </button>
                    </div>
                </x-card>
            @endforeach
        </div>
    </div>

    <div id="add-user-form" class="overlay hidden modal-form-container">
        <div class="rounded-lg max-w-lg w-10/12 mx-auto bg-white shadow py-5 px-6">
            <h2 class="mb-3 text-xl text-red-500">
                Форма добавления пользователя
            </h2>
            <form>
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700">Имя пользователя</label>
                    <div class="mt-1">
                        <input type="text" name="username" id="name"
                               class="px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500 disabled:shadow-none"
                               value="">
                    </div>
                </div>
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-slate-700">Описание</label>
                    <div class="mt-1">
                        <textarea type="text" name="description" id="description"
                                  class="px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500 disabled:shadow-none"
                        ></textarea>
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button id="button-add-user" type="button" class="bg-sky-500 hover:bg-sky-700 text-white btn-sm">
                        Добавить пользователя
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="edit-user-form" class="overlay hidden modal-form-container" data-user-id="">
        <div class="rounded-lg max-w-lg w-10/12 mx-auto bg-white shadow py-5 px-6">
            <h2 class="mb-3 text-xl text-red-500">
                Форма редактирования пользователя
            </h2>
            <form>
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700">Имя пользователя</label>
                    <div class="mt-1">
                        <input type="text" name="username" id="name"
                               class="px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500 disabled:shadow-none"
                               value="">
                    </div>
                </div>
                <div>
                    <label for="group" class="block text-sm font-medium text-slate-700">Группа</label>
                    <select name="group" id="group_id">
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-slate-700">Описание</label>
                    <div class="mt-1">
                        <textarea type="text" name="description" id="description"
                                  class="px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500 disabled:shadow-none"
                        ></textarea>
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button id="button-edit-user" type="button" class="bg-sky-500 hover:bg-sky-700 text-white btn-sm">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function removeCard(id) {
            var removingCard = $(`div.user-card#${id}`)
            removingCard.css('position', 'relative')
            removingCard.animate({
                opacity: 0,
                left: '80%'
            }, 1000, function () {
                removingCard.remove();
            })
        }

        function resolveIdForCardAction(actionCaller) {
            return actionCaller.parents('div.user-card').attr('id')
        }

        $('.edit-button').on('click', function () {
            var userID = resolveIdForCardAction($(this))
            console.log($(this))
            $('#edit-user-form').get(0).dataset.userId = userID;
            $.get(`/api/user/detail/${userID}`).done(function (data) {
                //removeCard(userID);
                $('#edit-user-form').toggleClass('hidden flex')
                console.log("SUCCESS", data);
                for (var key in data.record) {
                    $(`#edit-user-form #${key}`).val(data.record[key])
                    $(`#edit-user-form select#${key}`).find(`option[value="${data.record[key]}"]`).attr("selected", true)
                    console.log(key)
                }
            }).fail(function (errorData) {
                console.log("ERROR", errorData)
            })
        })
        $('#add-user').on('click', function () {
            $('#add-user-form').toggleClass('hidden flex')
        })
        $('.modal-form-container').on('click', function (e) {
            if (e.target.classList.contains('overlay')) {
                $(this).toggleClass('hidden flex')
                //$('#edit-user-form').toggleClass('hidden flex')
            }
        })
        $('.delete-button').on('click', function () {
            var userID = resolveIdForCardAction($(this))
            $.post(`/api/user/remove/${userID}`).done(function (data) {
                removeCard(userID);
                console.log("SUCCESS", data);
            }).fail(function (errorData) {
                console.log("ERROR", errorData)
            })
        });
        $('#button-add-user').on('click', function () {
            $.post('/api/user/add', {
                name: $('#add-user-form input#name').val(),
                _token: $('input[name="_token"]').val(),
                description: $('#add-user-form textarea#description').val(),
                group_id: $('select#group_id').val()
            }).done(function (data) {
                $('#add-user-form').toggleClass('hidden flex')
                console.log("Server response:", data);
            }).fail(function (errorData) {
                console.log(errorData)
            })
        })
        $('#button-edit-user').on('click', function () {
            var userID = $('#edit-user-form').get(0).dataset.userId;
            console.log($('select#group_id').val())
            $.post(`/api/user/edit/${userID}`, {
                name: $('#edit-user-form input#name').val(),
                _token: $('input[name="_token"]').val(),
                description: $('#edit-user-form textarea#description').val(),
                group_id: $('select#group_id').val()
            }).done(function (data) {
                $('#edit-user-form').toggleClass('hidden flex')
                console.log("Server response:", data);
            }).fail(function (errorData) {
                console.log(errorData)
            })
        })
    </script>
@endsection
