@extends('templates.app')

@section('app_container')
<div data-page="backoffice_books" class="app-container">
        @include('partials.side_menu')
        <section class="board-backoffice">
            <div class="block list-books">
                <h2><span class="sharp">#</span>&nbsp;Liste des livres empruntés</h2>
                @foreach ($books as $book)
                    @if ($book->isBorrowed)
                        <div class="item-book">
                            <div class="item-book-info">
                                <img src="{{ $book->small_thumbnail }}" alt="">
                                <p class="title-book"><span class="info-label">Titre:</span> {{ $book->title }}</p>
                                <p class="title-book"><span class="info-label">empreinté par </span> {{ $book->user->name }}</p>
                            </div>
                            <div class="item-book-button-block">
                                <a class="button-show" href="{{ route('singleBook', ['slug_categ' => $book->category->name,'id_book'=> $book->id]) }}" class="item-book-button">Voir le livre</a>
                                <a class="button-edit" href="{{ route('editBook', $book->id) }}" class="item-book-button">Éditer</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
</div>
@endsection