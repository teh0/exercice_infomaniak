@extends('templates.app')

@section('app_container')
<div data-page="book-category" class="app-container">
    <h1>Catégorie {{ $category->name }}</h1>
    @foreach($category->books as $book)
    <a href="{{ route('single', ['slug_categ' => $category->slug, 'title_book' => $book->title ]) }}">
        <h3>{{ $book->title }}</h3>
        <img src="{{ $book->url_thumbnail }}" alt="">
    </a>
    @endforeach
</div>
@endsection