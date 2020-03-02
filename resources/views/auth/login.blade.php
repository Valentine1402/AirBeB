@extends('layouts.base')

@section('main')
<div class="form-container">
    <div class="user-form">
        <h3>Login</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="E-Mail">
                @error('email')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required
                placeholder="Password">
                @error('password')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit">Login</button>
            </div>

            <div class="form-group">
                <a href="{{ route('register') }}">Non sei registrato? Registrati qui!</a>
            </div>
        </form>
    </div>
</div>
@endsection
