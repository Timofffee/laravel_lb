@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="float-left mt-2 mb-0">Все книги пользователя</p>
                    @if ($user->id != Auth::user()->id)
                        @if ($shared)
                            <a href="?shared=0" class="btn btn-secondary float-right">Отключить доступ к библиотеке</a>
                        @else
                            <a href="?shared=1" class="btn btn-primary float-right">Дать доступ к библиотеке</a>
                        @endif
                    @else
                        <a href="/create" class="btn btn-primary float-right">Добавить книгу</a>
                    @endif
                </div>
                

                <div class="card-body">
                    @include('inc.alert')
                    @if ($data)
                        @foreach ($data as $book)
                            @include ('inc.bookPreview')
                        @endforeach
                    @else
                        <p>Книги не найдены</p>
                    @endif
                </div>
                ヽ(*・ω・)ﾉ
            </div>
        </div>
    </div>
</div>
@endsection
