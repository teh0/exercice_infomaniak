@extends('templates.app')

@section('app_container')
<div data-page="search" class="app-container">
    <section>Ceci est la page search</section>

    @foreach ($books as $book)
        <h2>{{ $book->title }}</h2>
    <a href="{{ route('single', ['slug_categ'=>$book->category->slug, 'id_book'=>$book->id]) }}">Voir le livre</a>
    @endforeach
</div>
@endsection