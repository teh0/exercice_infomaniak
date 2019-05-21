@extends('templates.app')

@section('app_container')
<div data-page="profile" class="app-container">

    <section class="app-wrapper">
        {{-- User Infos --}}
        <div class="user-infos">
            <p class="header-user-infos"><span class="sharp">#</span>Profil de {{ Auth::user()->name }}</p>
            {{-- Thumbnail user --}}
            <div class="img-profile-container"><img src="{{ asset('upload/avatars/'.Auth::user()->avatar) }}" alt="">
            </div>
            {{-- Form to change Thumbnail --}}
            <form enctype="multipart/form-data" action="{{ route('update_avatar') }}" method="POST">
                @csrf
                <label for="avatar">Changer la photo</label>
                <input id="avatar" type="file" name="avatar" accept="image/x-png,image/gif,image/jpeg">
                <input type="submit">
            </form>
        </div>

        {{-- List of borrowed books --}}
        <div class="user-borrow">
            <p class="header-user-borrow"><span class="sharp">#</span> Vos Emprunts</p>
            <div class="list-borrow-book">
                @foreach (Auth::user()->books as $book)
                <div class="block-borrow-book">
                    <img src="{{ $book->small_thumbnail }}" alt="">
                    <a class="link-borrow" href="" onclick="event.preventDefault(); document.getElementById('unborrow-form').submit();">Rendre le
                        livre</a>
                    <form id="unborrow-form" action="{{ route('unborrowBook', ['id_book' => $book->id]) }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </div>
                <br>
                @endforeach
            </div>
        <p class="book-credit">Vous pouvez encore emprunter <span>{{ 3 - Auth::user()->countBooks }} @if ((3 - Auth::user()->countBooks) <= 1) livre @else livres @endif</span></p>
            <a href="{{ route('collectionBook') }}" class="back-button">Voir tous les livres</a>
        </div>

    </section>
</div>
@endsection