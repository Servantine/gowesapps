<nav>
    <a href="{{ route('home') }}">Home</a>

    <!-- Form Logout -->
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>

<h1>Welcome Admin</h1>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>