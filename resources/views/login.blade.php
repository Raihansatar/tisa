login page

@extends('layouts.main')


@section('content')
    
    @include('panels.flash-message')
    
    <form class="form form-control" action="{{ Route('login.process') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="" class="form-label">Username</label>
        <input type="text" name="username" id="" class="form-control">
        <label for="" class="form-label">Password</label>
        <input type="password" name="password" id="" class="form-control">
        <button type="submit" class="btn btn-sm btn-primary"> Login </button>
    </form>
    
@endsection