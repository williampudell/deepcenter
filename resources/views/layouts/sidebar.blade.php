<div id='sidebar' class='sidenav'>
    <a href="#" class='closebtn' onclick="closeNavbar()">&times;</a>
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('members.index') }}">Membros</a>
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
