<h1>Register SIPAS Kampus</h1>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <label>Nama Lengkap</label>
    <input type="text" name="name" value="{{ old('name') }}" required>

    <label>NPM</label>
    <input type="text" name="npm" value="{{ old('npm') }}" required>

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>

    <label>Password</label>
    <input type="password" name="password" required minlength="8">

    <label>Konfirmasi Password</label>
    <input type="password" name="password_confirmation" required minlength="8">

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    <button type="submit">Register</button>
</form>

<a href="{{ route('login') }}">Sudah punya akun? Login</a>
