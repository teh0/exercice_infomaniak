@extends('templates.app')

@section('app_container')
<div data-page="reset-password" class="app-container">
<div class="login-overlay overlay"></div>

    <form action="{{ route('password.update') }}" method="POST" class="form-borrowell">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-header">
            <p><span class="sharp">#</span>&nbsp;Réinitialiser le mot de passe</p>
        </div>
        <!-- Email block -->
        <div class="block-form">
            @error('email')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <input type="email" placeholder="E-mail" class=" @error('email') invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>

        <!-- Password block -->
        <div class="block-form">
            @error('password')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <input type="password" placeholder="Nouveau mot de passe" class=" @error('password') invalid @enderror" name="password" required>
        </div>

        <!-- Reset Password block -->
        <div class="block-form">
            <input type="password" placeholder="Confirmez votre nouveau mot de passe" name="password_confirmation" required>
        </div>

        <!-- Button submit -->
        <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
    </form>
</div>
@endsection
