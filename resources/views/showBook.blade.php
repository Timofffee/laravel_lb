@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if ($book == null)
                        <p class="float-left mt-2 mb-0">Упс..</p>
                </div>

                <div class="card-body">
                    <p class="">Кажется, книга удалена или ещё не создана..</p>
                </div>
                    @else
                        <p class="float-left mt-2 mb-0">{{ $book->title }}</p>
                        @if (Auth::check() && $book->owner == Auth::user()->id)
                            @if ($book->shared)
                                <a href="/book/{{ $book->id }}?shared=0" class="btn btn-secondary float-right">Закрыть доступ по ссылке</a>
                            @else
                                <a href="/book/{{ $book->id }}?shared=1" class="btn btn-primary float-right">Сделать книгу доступной для всех (по ссылке)</a>
                            @endif
                        @endif
                </div>

                <div class="card-body">
                    <p class="">{{ $book->text }}</p>
                </div>
                    @endif
                
                ヽ(*・ω・)ﾉ
            </div>
        </div>
    </div>
</div>
@endsection
