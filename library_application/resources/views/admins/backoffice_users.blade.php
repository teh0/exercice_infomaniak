@extends('templates.app')

@section('app_container')
<div data-page="backoffice_users" class="app-container">
        @include('partials.side_menu')
        <section class="board-backoffice">
            <div class="block list-users">
                <h2><span class="sharp">#</span>&nbsp;Liste des libraires</h2>
                @foreach ($users as $user)
                    @if ($user->role === 'admin')
                        <div class="item-user">
                            <div class="item-user-info">
                                <img src="{{ asset('upload/avatars/'.$user->avatar) }}" alt="">
                                <p class="name-user"><span class="info-label">Nom:</span> {{ $user->name }}</p>
                                <p class="count-book-user"><span class="info-label">Nombre de livres empruntés:</span> {{ $user->countBooks }}</p>
                            </div>
                            <a href="mailto:{{ $user->email }}" class="item-user-button-contact">Contacter</a>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="block list-users">
                    <h2><span class="sharp">#</span>&nbsp;Liste des utilisateurs</h2>
                @foreach ($users as $user)
                    @if ($user->role === 'user')
                        <div class="item-user">
                            <div class="item-user-info">
                                <img src="{{ asset('upload/avatars/'.$user->avatar) }}" alt="">
                                <p class="name-user"><span class="info-label">Nom:</span> {{ $user->name }}</p>
                                <p class="count-book-user"><span class="info-label">Nombre de livres empruntés:</span> {{ $user->countBooks }}</p>
                            </div>
                            <a href="mailto:{{ $user->email }}" class="item-user-button-contact">Contacter</a>
                        </div>
                    @endif 
                @endforeach
            </div>
            <div class="block count-users">
                <h2><span class="sharp">#</span>&nbsp;Nombre total d'utilisateur</h2>
                <div class="total-users">{{ sizeof($users) }}</div>
                <p>Dernière personne enregistrée: <span class="last-user">{{ $lastuser->name }}</span></p>
            </div>
        </section>
</div>
@endsection