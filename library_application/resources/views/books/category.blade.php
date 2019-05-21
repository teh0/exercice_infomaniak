@extends('templates.app')

@section('app_container')
<div data-page="book-category" class="app-container">
        <a class="back-button" href="{{ route('collection') }}"><img src="{{ asset('img/svg/left_arrow.svg') }}" alt=""><span>Revenir à la collection</span></a>
    <p class="header-result"><span class="count-book">{{ sizeof($category->books) }}</span> livres pour la catégorie <span class="sharp">#</span>&nbsp;<span class="title-category">{{ $category->name }}</span></p>
    <section class="app-wrapper">
        @foreach($category->books as $book)
            <a class="block-book" href="{{ route('single', ['id_book' => $book->id,'slug_categ' => $category->slug]) }}">

                <img src="{{ $book->small_thumbnail }}" alt="">
            </a>
        @endforeach
    </section>
</div>
@endsection