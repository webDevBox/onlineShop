@extends('layout.panel')

@section('content')
<div class="row">
    <h1 class="text-center text-success mt-2"> Edit <strong> {{$product->name}} </strong> Product</h1>
    @if(Session::has('success'))
    <p class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-success') }}">
    {{ Session::get('success') }} </p>
    @endif
    @if(Session::has('error'))
    <p class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-danger') }}">
        {{ Session::get('error') }}</p>
    @endif 
    @if ($errors->has('name')) <p style="color:red;" class="text-center">{{ $errors->first('name') }}</p> @endif 
    @if ($errors->has('price')) <p style="color:red;" class="text-center">{{ $errors->first('price') }}</p> @endif
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 offset-lg-3 offset-md-3">
        <form action="{{route('updateProduct',[$product->id])}}" method="POST" class="p-5 bg-white form rounded mt-5">
            @csrf
            <div class="form-group">
                <label for=""> Name </label>
                <input type="text" name="name" class="form-control" value="{{$product->name}}">
            </div>
            <div class="form-group">
                <label for=""> Price </label>
                <input type="tel" name="price" class="form-control" value="{{$product->price}}">
            </div>
            
            <input type="submit" name="submit" value="Update" class="btn btn-primary d-block mx-auto mt-3">
        </form>
    </div>
</div>
@endsection