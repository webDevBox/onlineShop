@extends('layout.panel')

@section('content')
<div class="row">
    <h1 class="text-center text-success mt-2"> Edit <strong> {{$user->name}} </strong> User</h1>
    @if(Session::has('success'))
    <p class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-success') }}">
    {{ Session::get('success') }} </p>
    @endif
    @if(Session::has('error'))
    <p class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-danger') }}">
        {{ Session::get('error') }}</p>
    @endif 
    @if ($errors->has('name')) <p style="color:red;" class="text-center">{{ $errors->first('name') }}</p> @endif 
    @if ($errors->has('phone')) <p style="color:red;" class="text-center">{{ $errors->first('phone') }}</p> @endif
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 offset-lg-3 offset-md-3">
        <form action="{{route('edit_user_db',array('id'=>$user->id))}}" method="POST" class="p-5 bg-white form rounded mt-5">
            @csrf
            <div class="form-group">
                <label for=""> Name </label>
                <input type="text" name="name" class="form-control" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for=""> Phone </label>
                <input type="tel" name="phone" class="form-control" value="{{$user->email}}">
            </div>
            
            <input type="submit" name="submit" value="Update" class="btn btn-primary d-block mx-auto mt-3">
        </form>
    </div>
</div>
@endsection