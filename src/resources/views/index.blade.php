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
        <h2 class="create-form__title">新規作成</h2>
        <form class="create-form__inner" action="/todos" method="post">
            @csrf
            <div class="create-form__input">
                <input type="text" name="content" value="{{ old('content') }}" class="create-form__input-text" placeholder="Todoを入力">
            </div>
            <div class="create-form__category">
                <select class="category__select" name="category_id" id="category_id">
                    <option value="">カテゴリ</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
            </select>
            @if($errors->has('category_id'))
                <div class="error">{{ $errors->first('category_id') }}</div>
                @endif
            </div>
            <div class="create-form__button">
                <button type="submit" class="create-form__button-submit">作成</button>
            </div>
        </form>
    </div>
    <div class="create-form">
        <h2 class="create-form__title">Todo検索</h2>
        <form class="create-form__inner" action="/todos/search" method="get">
            @csrf
            <div class="create-form__input">
                <input type="text" name="content" value="{{ old('content') }}" class="create-form__input-text" placeholder="Todoを検索">
            </div>
            <div class="create-form__category">
                <select class="category__select" name="category_id" id="category_id">
                    <option value="">カテゴリ</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="create-form__button">
                <button type="submit" class="create-form__button-submit">検索</button>
            </div>
        </form>
    </div>
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
                <th class="todo-table__category">カテゴリ</th>
            </tr>
            @foreach($todos as $todo)
            <tr class="todo-table__row">
                <form class="update-form" action="/todos/update" method="post">
                    @csrf
                    @method('patch')
                    <td class="update-form__input">
                        <input class="update-form__input-text" type="text" name="content" value="{{ $todo->content }}">
                        <input type="hidden" name="id" value="{{ $todo->id }}">
                    </td>
                    <td class="update-form__input">
                            <!-- 現在のカテゴリーを表示 -->
                            <select class="category__select" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $todo->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    <td class="update-form__button">
                        <button type="submit" class="update-form__button-submit">更新</button>
                    </td>
                </form>
                <form class="delete-form" action="/todos/delete" method="post">
                    @csrf
                    @method('delete')
                    <td class="delete-form__button">
                        <input type="hidden" name="id" value="{{ $todo->id }}">
                        <button type="submit" class="delete-form__button-submit">削除</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection