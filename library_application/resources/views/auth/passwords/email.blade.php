@extends('templates.app')

@section('app_container')
<div data-page="email-password" class="app-container">
<div class="login-overlay overlay"></div>
    @if (session('status'))
        <div class="success-message">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('password.email') }}" method="POST" class="form-borrowell">
        @csrf

        <div class="form-header">
            <p><span class="sharp">#</span>&nbsp;Vérification par mail</p>
        </div>
        <!-- Email block -->
        <div class="block-form">
            @error('email')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <input type="email" placeholder="E-mail" class=" @error('email') invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>

        <!-- Button submit -->
        <button type="submit" class="btn btn-primary">Envoyer le lien de réinitialisation</button>
    </form>
</div>
@endsection