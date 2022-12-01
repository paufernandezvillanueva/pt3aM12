<!-- Navigation -->
<nav>
    @if (Auth::check())
        <a><strong>Estàs loguejat amb '{{ Auth::user()->name}}'.</strong></a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
        <br>
        <br>
    @endif
    <a href="{{ route('home') }}">Inici</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('llibre_list') }}">Llibres</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('autor_list') }}">Autors</a>
    &nbsp;&nbsp;&nbsp;
    @if (!Auth::check())
        <a href="{{ route('login') }}">Log In</a>
        &nbsp;&nbsp;&nbsp;
        <a href="{{ route('register') }}">Register</a>
    @endif
</nav>