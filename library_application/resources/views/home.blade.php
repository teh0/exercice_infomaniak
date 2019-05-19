@extends('templates.app')

@section('app_container')
<div data-page="home" class="app-container">
    <div class="home-overlay overlay"></div>
    <section>
        @guest
        <span class="home-message">Bienvenue sur Borrowell</span>
        @endguest
        @auth
        <span class="home-message">Bienvenue {{{ Auth::user()->name }}}</span>
        @endauth
        <form action="" method="post">
            <input type="text" name="search-book" placeholder="Rechercher un livre sur ..." autofocus>
            <button type="submit"><img src="{{ asset('img/svg/search.svg')}}" alt=""></button>
        </form>
        <a class="link-book-collection" href="{{ route('collection') }}">Voir tous les livres</a>
    </section>
</div>
@endsection