@extends('layout.page')

@section('content')
    
<div class="row">
    <h1 class="text-center text-success mt-2"> Login Form </h1>
    @if(Session::has('success'))
    <p class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-success') }}">
    {{ Session::get('success') }} </p>
    @endif
    @if(Session::has('error'))
    <p class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-danger') }}">
        {{ Session::get('error') }}</p>
    @endif 
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 offset-lg-3 offset-md-3">
        <form action="{{route('login')}}" method="POST" class="p-5 bg-white form rounded mt-5">
            @csrf
            <div class="form-group">
                <label for=""> Email </label>
                <input type="email" name="email" class="form-control" placeholder="Enter Your Email Address">
            </div>
            <div class="form-group">
                <label for=""> Password </label>
                <input type="password" name="password" class="form-control" placeholder="Enter Your Password">
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary d-block mx-auto mt-3">
        </form>
    </div>
</div>

@endsection