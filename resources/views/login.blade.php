<h1>Login SIPAS Kampus</h1>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>

    <label>Password</label>
    <input type="password" name="password" required>

    @if ($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif

    <button type="submit">Login</button>
</form>

<a href="{{ route('register') }}">Belum punya akun? Register</a>
