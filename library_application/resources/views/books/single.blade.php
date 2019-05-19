@extends('templates.app')

@section('app_container')
<div data-page="book-single" class="app-container">
    <div class="thumbnail-container">
        <img src="{{ $book->large_thumbnail }}" alt="Page de couverture du livre {{ $book->title }}">
        <div class="overlay-thumbnail overlay"></div>
    </div>
    <div class="info-container">
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
        <a data-state="noBorrowed" class="link-borrow" href="">Empreinter ce livre</a>
        @endauth

        @else
        @auth
        <a data-state="Borrowed" class="link-borrow" href="" onclick="event.preventDefault();">Ce livre est déjà
            empreinté</a>
        @endauth
        @endif
        @guest
        <p class="link-login"><a href="{{ route('login') }}">Identifiez-vous</a> si vous voulez emprunter ce livre</p>
        @endguest
    </div>



    {{-- <section class="app-wrapper">
        <p class="book-title">{{ $book->title }}</p>
    <div class="info-container">
        <!-- Thumbnail -->
        <div class="thumb-block">
            <img class="book-thumb" src="{{ $book->large_thumbnail }}" alt="">
            @if (!$book->isBorrowed)
            @auth
            <a data-state="noBorrowed" class="link-borrow" href="">Empreinter ce livre</a>
            @endauth

            @else
            @auth
            <a data-state="Borrowed" class="link-borrow" href="" onclick="event.preventDefault();">Ce livre est déjà
                empreinté</a>
            @endauth
            @endif
            @guest
            <p class="link-login"><a href="{{ route('login') }}">Identifiez-vous</a> si vous voulez emprunter ce livre
            </p>
            @endguest

        </div>
        <!-- Text description container -->
        <div class="text-description">
            <div class="text-description-block">
                <span>Description</span>
                <p>{{ urldecode($book->description) }}</p>
            </div>

            <div class="text-description-block">
                <span>Auteur</span>
                <p>{{ $book->authors }}</p>
            </div>

            <div class="text-description-block">
                <span>Nombre de page</span>
                <p>{{ $book->pageCount }}</p>
            </div>
        </div>
    </div>
    </section> --}}
</div>
@endsection