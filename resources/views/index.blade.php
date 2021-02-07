@extends('layouts.main')



@section('content')
    @guest
        Jadi tok eh? jadi kei

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
@endsection

