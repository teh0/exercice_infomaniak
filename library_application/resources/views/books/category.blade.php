@extends('templates.app')

@section('app_container')
<div data-page="book-category" class="app-container">
        <a class="back-button" href="{{ route('collectionBook') }}"><img src="{{ asset('img/svg/left_arrow.svg') }}" alt=""><span>Revenir à la collection</span></a>
    <p class="header-result"><span class="count-book">{{ sizeof($category->books) }}</span> livres pour la catégorie <span class="sharp">#</span>&nbsp;<span class="title-category">{{ $category->name }}</span></p>
    <section class="app-wrapper">
        @foreach($category->books as $book)
            <a class="block-book" href="{{ route('singleBook', ['id_book' => $book->id,'slug_categ' => $category->slug]) }}">

                <img src="@if($book->fromApi) {{ $book->small_thumbnail }} @else {{ asset('upload/thumbnails').'/'.$book->small_thumbnail }} @endif" alt="">
            </a>
        @endforeach
    </section>
</div>
@endsection