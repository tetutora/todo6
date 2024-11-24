@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="alert__message">
    @if(session('message'))
    <div class="alert__message-success">{{ session('message') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert__message-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
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
            @foreach($todos as $todo)
            <tr class="todo-table__row">
                <form class="update-form" action="/todos/update" method="post">
                    @csrf
                    @method('patch')
                    <td class="update-form__input">
                        <input class="update-form__input-text" type="text" name="content" value="{{ $todo['content'] }}">
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                    </td>
                    <td class="update-form__button">
                        <button type="submit" class="update-form__button-submit">更新</button>
                    </td>
                </form>
                <form class="delete-form" action="/todos/delete" method="post">
                    @csrf
                    @method('delete')
                    <td class="delete-form__button">
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        <button type="submit" class="delete-form__button-submit">削除</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection