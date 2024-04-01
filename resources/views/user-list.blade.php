@extends('layout')
@section('title', 'Список пользователей')
@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8 text-blue-600">
        <button id="add-user"
                class="bg-red-400 mb-3 hover:bg-red-600 px-5 py-2.5 text-sm leading-5 rounded-md font-semibold text-white">
            Добавить пользователя
        </button>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 lg:gap-3">
            @foreach ($users as $user)
                <x-card link="laravel.com" class="user-card" id="{{ $user->id }}">
                    <x-slot:title>{{ $user->name }}</x-slot:title>
                    {{ $user->description }}
                    <div class="top-right-corner tools">
                        <button class="btn bg-blue-300 hover:bg-blue-400 text-white delete-button">
                            Удалить
                        </button>
                        <button class="btn bg-green-300 hover:bg-green-400 text-white edit-button">
                            Редактировать
                        </button>
                    </div>

                </x-card>
            @endforeach
        </div>
    </div>

    <div id="edit-user-form" class="overlay hidden">
        <div class="rounded-lg max-w-lg w-10/12 mx-auto bg-white shadow py-5 px-6">
            <form>
                @csrf
                <!--<input type="hidden" name="_token" value="{{ csrf_token() }}" />-->
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700">Имя пользователя</label>
                    <div class="mt-1">
                        <input type="text" name="username" id="username"
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
            $.get(`/api/user/detail/${userID}`).done(function (data) {
                //removeCard(userID);
                console.log("SUCCESS", data);
            }).fail(function (errorData) {
                console.log("ERROR", errorData)
            })
        })
        $('#add-user').on('click', function () {
            $('#edit-user-form').toggleClass('hidden flex')
        })
        $('#edit-user-form').on('click', function (e) {
            if (e.target.id === 'edit-user-form') {
                $('#edit-user-form').toggleClass('hidden flex')
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
                name: $('#edit-user-form input#username').val(),
                _token: $('input[name="_token"]').val(),
                description: $('#edit-user-form textarea#description').val()
            }).done(function (data) {
                console.log(data);
            }).fail(function (errorData) {
                console.log(errorData)
            })
        })
    </script>
@endsection
