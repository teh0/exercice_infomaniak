@extends('templates.app')

@section('app_container')
<div data-page="register" class="app-container">
<div class="login-overlay overlay"></div>
    <form action="{{ route('register' )}}" method="POST" class="form-borrowell">
        @csrf

        <div class="form-header">
            <p><span class="sharp">#</span>&nbsp;Créer un compte</p>
        </div>

        <!-- Name block -->
        <div class="block-form">
            @error('name')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <input type="text" placeholder="Nom et Prénom" class="@error('name') invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        </div>

        <!-- Email block -->
        <div class="block-form">
            @error('email')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <input type="email" placeholder="E-mail" class="@error('email') invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>

        <!-- Password block -->
        <div class="block-form">
            @error('password')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <input type="password" placeholder="Mot de passe" class=" @error('password') invalid @enderror" name="password" required autocomplete="current-password">
        </div>

        <!-- Confirm Password block -->
        <div class="block-form">
            <input type="password" placeholder="Confirmez le mot de passe" name="password_confirmation" required autocomplete="new-password">
        </div>

        <!-- Button submit -->
        <button type="submit" class="btn btn-primary">S'enregistrer</button>
    </form>
</div>
@endsection