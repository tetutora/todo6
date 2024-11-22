@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="alert__message">
    <div class="alert__message-success">Todoを作成しました</div>
</div>

<div class="todo__content">
    <div class="create-form">
        <form class="create-form__inner" action="/todos" method="post">
            @csrf
            <div class="create-form__input">
                <input type="text" name="content" value="" class="create-form__input-text">
            </div>
            <div class="create-form__button">
                <button type="submit" class="create-form__button-submit">作成</button>
            </div>
        </form>
    </div>
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
            </tr>
            <tr class="todo-table__row">
                <form class="update-form" action="/todos/update" method="post">
                    @csrf
                    @method('patch')
                    <td class="update-form__input">
                        <input class="update-form__input-text" type="text" name="content" value="">
                    </td>
                    <td class="update-form__button">
                        <button type="submit" class="update-form__button-submit">作成</button>
                    </td>
                </form>
                <form class="delete-form" action="/todos/delete" method="post">
                    <td class="delete-form__button">
                        <button type="submit" class="delete-form__button-submit">削除</button>
                    </td>
                </form>
            </tr>
        </table>
    </div>
</div>
@endsection