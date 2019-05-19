@extends('templates.app')

@section('app_container')
<div data-page="profile" class="app-container">

    <section class="app-wrapper">
        <div class="profile-container">
            <p>Profil de {{ Auth::user()->name }}</p>
            <div class="img-profile-container"><img src="{{ asset('upload/'.Auth::user()->avatar) }}" alt=""></div>
            @foreach (Auth::user()->books as $book)
            <div class="block-borrow">
            <span>{{ $book->title }}</span>
            <a class="link-borrow" href="" onclick="event.preventDefault(); document.getElementById('unborrow-form').submit();">Rendre le livre</a>
            <form id="unborrow-form" action="{{ route('unborrowBook', ['id_book' => $book->id]) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            </div>
            <br>
            @endforeach
    </section>
</div>
</div>
@endsection