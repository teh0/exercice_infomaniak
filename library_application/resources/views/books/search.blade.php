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
                    <span class="book-title">{{ $book->title }}</span>
                    <img src="@if($book->fromApi) {{ $book->small_thumbnail }} @else {{ asset('upload/thumbnails').'/'.$book->small_thumbnail }} @endif" alt="">
                </div>
                <a href="{{ route('singleBook', ['slug_categ'=>$book->category->slug, 'id_book'=>$book->id]) }}">Voir le livre</a>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection