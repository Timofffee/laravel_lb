<div class="card mb-2">
    <div class="card-body">
        <h2>{{ $book->title }}</h2>
        <p>{{ $book->text }}</p>
        <a href="/book/{{ $book->id }}" class="btn btn-primary float-right">Прочитать</a>
        @if ($book->owner == Auth::id())
        <a href="/edit/{{ $book->id }}" class="btn float-right">Редактировать</a>
        @endif
    </div>
</div>