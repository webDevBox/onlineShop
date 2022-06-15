@extends('layout.panel')
@section('content')
<div class="container">
    <div class="row">
        <div class="offset-3 col-6">
            <form action="{{ route('addOrder') }}" method="post" class="mt-5">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="form-group">
                    <select name="product" class="form-control">
                        <option selected disabled>Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="paid" placeholder="Enter Paid Amount">
                </div>
                <center><input type="submit" value="Add" class="btn btn-success"></center>
            </form>
        </div>
    </div>
</div>
@endsection