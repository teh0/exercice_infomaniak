@extends('templates.app')

@section('app_container')
<div data-page="book-single" class="app-container">
    <section class="app-wrapper">
        {{ $book->title }}
    </section>
</div>
@endsection