@extends('templates.app')

@section('app_container')
<div data-page="profile" class="app-container">

    <section class="app-wrapper">
        {{-- User Infos --}}
        <div class="user-infos">
            <p>Profil de {{ Auth::user()->name }}</p>
            {{-- Thumbnail user --}}
            <div class="img-profile-container"><img src="{{ asset('upload/avatars/'.Auth::user()->avatar) }}" alt="">
            </div>
            {{-- Form to change Thumbnail --}}
            <form enctype="multipart/form-data" action="{{ route('update_avatar') }}" method="POST">
                @csrf
                <input type="file" name="avatar">
                <input type="submit">
            </form>
        </div>

        {{-- List of borrowed books --}}
        <div class="user-borrow-list">
            @foreach (Auth::user()->books as $book)
            <div class="block-borrow">
                <span>{{ $book->title }}</span>
                <a class="link-borrow" href=""
                    onclick="event.preventDefault(); document.getElementById('unborrow-form').submit();">Rendre le
                    livre</a>
                <form id="unborrow-form" action="{{ route('unborrowBook', ['id_book' => $book->id]) }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
            </div>
            <br>
            @endforeach
        </div>

    </section>
</div>
@endsection