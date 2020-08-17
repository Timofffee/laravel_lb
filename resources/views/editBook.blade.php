@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="float-left mt-2 mb-0">Добавление книги</p>
                </div>
                

                <div class="card-body">
                    @include('inc.alert')
                    <form action="{{ route('edit', $book->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Название книги</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ $book->title }}">
                            <label for="text">Текст книги</label>
                            <textarea class="form-control" name="text" id="text">{{ $book->text }}</textarea>
                        </div>
                        <a href="/delete/{{ $book->id }}" class="btn btn-outline-danger float-right">Удалить книгу</a>
                        <button type="submit" class="btn btn-primary float-left">Обновить книгу</button>
                    </form>
                </div>
                ヽ(*・ω・)ﾉ
            </div>
        </div>
    </div>
</div>
@endsection