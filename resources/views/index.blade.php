@extends('layouts.main')



@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                @guest
                    Takdop gapo sini, tok tahu nok letok gapo, tekey <a href="{{ route('login') }}">login</a> jah.
                    
                    <button id="tekey"> Kalu tekey sini?</button>
            
                    <script>
                        $('document').ready(function(){
                            $('#tekey').click(function(){
                            alert('guano tekey, sekalo bereh');
                            })
                        })
            
                    </script>
                @endguest
                @role('admin')
                    Admin tisa duk sini,
                    lek luhh, barey tok siap lagi,
                    otw
                @endrole
                @role('user')
                    Welcome {{ Auth::user()->username }} .
                @endrole
            </div>
            
        </div>

    </div>
@endsection

