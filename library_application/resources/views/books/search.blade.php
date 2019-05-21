@extends('templates.app')

@section('app_container')
<div data-page="search" class="app-container">
    <section class="app-wrapper">
        <div class="header-search">
            <p><span class="sharp">#</span>Résultat de votre recherche</p>
        </div>
        <div class="list-result-book">
            @foreach ($books as $book)
            <div class="block-result">
                <div>
                    <h2>{{ $book->title }}</h2>
                    <img src="{{ $book->small_thumbnail }}" alt="">
                </div>
                <a href="{{ route('single', ['slug_categ'=>$book->category->slug, 'id_book'=>$book->id]) }}">Voir le livre</a>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection