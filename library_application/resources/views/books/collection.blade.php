@extends('templates.app')

@section('app_container')
<div data-page="book-collection" class="app-container">
    <section class="app-wrapper">
        @foreach($categories as $category)
            <a class="block-category" href="{{ route('category', ['slug_categ' => $category->slug ]) }}">
                <img src="{{ asset('img/'.$category->slug.'.png') }}" alt="">
                <p class="title-category">{{ $category->name }}</p>
            </a>
        @endforeach
    </section>
</div>
@endsection