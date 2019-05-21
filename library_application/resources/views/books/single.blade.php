@extends('templates.app')

@section('app_container')
<div data-page="book-single" class="app-container">
    <div class="thumbnail-container">
        <div class="overlay-thumbnail overlay"></div>
        <img src="{{ $book->large_thumbnail }}" alt="Page de couverture du livre {{ $book->title }}">
    </div>
    <div class="info-container">
            <a class="back-button" href="{{ route('categoryBook',['slug_category' => $book->category->slug]) }}"><img src="{{ asset('img/svg/left_arrow.svg') }}" alt=""><span>Revenir aux livres {{$book->category->name}}</span></a>
        <p class="book-title"><span class="sharp">#</span> {{ $book->title }}</p>
        <div class="description-block">
            <span>Description</span>
            <p>{{ urldecode($book->description) }}</p>
        </div>
        <div class="description-block">
            <span>Auteur</span>
            <p>{{ urldecode($book->authors) }}</p>
        </div>
        <div class="description-block">
            <span>Nombre de page</span>
            <p>{{ urldecode($book->pageCount) }}</p>
        </div>
        @if (!$book->isBorrowed)
            @auth
                @if (Auth::user()->countBooks>=3)
                    <span class="limit-book">Vous ne pouvez pas empreinter plus de 3 livres</span>
                @else
                    <a data-state="noBorrowed" class="link-borrow" href="" onclick="event.preventDefault(); document.getElementById('borrow-form').submit();">Empreinter ce livre</a>
                    <form id="borrow-form" action="{{ route('borrowBook', ['id_book' => $book->id]) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
            @endauth

        @else
            @auth
                @if (Auth::user()->id == $book->user_id)
                    <span class="owner-message">Vous possédez ce livre</span>
                @else
                <a data-state="Borrowed" class="link-borrow" href="" onclick="event.preventDefault();">Ce livre est déjà
                        empreinté</a>
                @endif
            @endauth
        @endif
        @guest
        <p class="link-login"><a href="{{ route('login') }}">Identifiez-vous</a> si vous voulez emprunter ce livre</p>
        @endguest
    </div>
</div>
@endsection