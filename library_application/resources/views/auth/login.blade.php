@extends('templates.app')

@section('app_container')
<div data-page="login" class="app-container">
<div class="login-overlay overlay"></div>
    <form action="{{ route('login' )}}" method="POST" class="form-borrowell">
        @csrf

        <div class="form-header">
            <p><span class="sharp">#</span>&nbsp;Identifiez-vous</p>
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
            @error('email')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <input type="password" placeholder="Mot de passe" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        </div>
        @if (Route::has('password.request'))
            <a class="link-forgot-password" href="{{ route('password.request') }}">J'ai oublié mon mot de passe</a>
        @endif

        <!-- Button submit -->
        <button type="submit" class="btn btn-primary">S'identifier</button>
    </form>
</div>
@endsection