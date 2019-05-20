@extends('templates.app')

@section('app_container')
<div data-page="search" class="app-container">
    <div class="home-overlay overlay"></div>
    <section>Ceci est la page search</section>

    @foreach ($books as $book)
        <h2>{{ $book->title }}</h2>
    @endforeach
</div>
@endsection