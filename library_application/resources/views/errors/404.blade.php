@extends('templates.app')

@section('app_container')
<div data-page="error-page" class="app-container">
    <img src="{{ asset('img/logo_borrowell_reduce.svg') }}" alt="">
    <span>Vous ne trouverez aucun livre par ici</span>
<a href="{{ route('home') }}">Retour à l'accueil</a>
</div>
@endsection