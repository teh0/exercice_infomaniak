@extends('templates.app')

@section('app_container')
<div data-page="book-single" class="app-container">
    <section class="app-wrapper">
        <p class="book-title">{{ $book->title }}</p>
        <img src="{{ $book->url_thumbnail }}" alt="">
        <p class="book-description">{{ urldecode ($book->description) }}</p>
    </section>
</div>
@endsection