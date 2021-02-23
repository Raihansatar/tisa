

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FBF6F0;">
        <div class="container">
            <a class="navbar-brand" href="{{ Route('index') }}">Logo Tisa Sini kei</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> 
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @role('admin')
                    @include('layouts.navbar.admin')
            @endrole
            @role('user')
                    @include('layouts.navbar.user')
            @endrole
                </ul>
            @auth
                <div class="d-flex navbar-nav">
                    <a class="nav-link" aria-current="page" href="{{ Route('logout') }}">Logout</a>
                </div>
                    
            @endauth
            @guest
                <div class="d-flex navbar-nav">
                    <a class="nav-link" aria-current="page" href="{{ Route('login') }}">Login</a>
                </div>
            @endguest

            </div>
        </div>
    </nav>