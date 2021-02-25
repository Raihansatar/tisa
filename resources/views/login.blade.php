

@extends('layouts.main')


@section('content')
    
    @include('panels.flash-message')
    
    <div class="container">

        <form class="form fv-plugins-bootstrap fv-plugins-framework" novalidate="novalidate" id="kt_login_signin_form" action="{{ Route('login.process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="pb-5 pt-lg-0 pt-5">
                <h3 class="font-weight-bolder text-dark font-size-h4">Welcome!!!</h3>
            </div>
            <div class="form-group fv-plugins-icon-container">
                <label class= font-weight-bolder text-dark">Username</label>
                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="username" autocomplete="off">
            <div class="fv-plugins-message-container"></div></div>
            <div class="form-group fv-plugins-icon-container">
                <div class="d-flex justify-content-between mt-n5">
                    <label class= font-weight-bolder text-dark pt-5">Password</label>
                </div>

                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" autocomplete="off">
            <div class="fv-plugins-message-container"></div></div>
            <div class="pb-lg-0 pb-5">
                <button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bolder px-8 py-4 my-3 mr-3">Sign In</button>

            </div>
        </form>

    </div>
    
@endsection