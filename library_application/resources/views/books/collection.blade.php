@extends('templates.app')

@section('app_container')
<div data-page="book-collection" class="app-container">
    <section class="app-wrapper">
        @foreach($categories as $category)
            <a class="block-category" href="{{ route('category', ['slug_categ' => $category->slug ]) }}">
                <h1>{{ $category->name }}</h1>
            </a>
        @endforeach
    </section>
</div>
@endsection