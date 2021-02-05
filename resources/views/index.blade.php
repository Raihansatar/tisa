@extends('layouts.main')



@section('content')
    @guest
        Test kat sini, ni guest
    @endguest
    @role('admin')
        Admin duk sini
    @endrole
@endsection

