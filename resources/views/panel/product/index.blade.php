@extends('layout.panel')
@section('content')
<div class="container">
    
<div class="row">
<div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
    <h3> All Products </h3>
    @if(Session::has('success'))
    <p class="col-lg-4 col-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-success') }}">
    {{ Session::get('success') }} </p>
    @endif
    @if(Session::has('error'))
    <p class="col-lg-4 col-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-danger') }}">
        {{ Session::get('error') }}</p>
    @endif 
    @if ($errors->has('name')) <p style="color:red;">{{ $errors->first('name') }}</p> @endif 
    @if ($errors->has('price')) <p style="color:red;">{{ $errors->first('price') }}</p> @endif 
</div>
<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
    <a href="#" class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#buyer"> Add Product </a>
</div>
<div class="offset-lg-8 offset-md-8 col-lg-3 col-md-3 col-sm-4 col-xs-4">
    <input class="form-control" id="myInput" type="text" placeholder="Search..">
</div>
</div> 
<div class="table-responsive">
    <table class="table table-hover table-border">
<thead>
    <tr>
        <th> Name </th>
        <th> Price </th>    
        <th> Added </th>    
        <th> Action </th>    
    </tr>  
</thead>
<tbody id="myTable">
  
    @foreach ($products as $product)
    <tr>
        <td> {{$product->name}} </td>
        <td> Rs: {{$product->price}} </td>    
        <td> {{$product->created_at}} </td>    
        <td> 
            <div class="btn-group">
                <a href="{{route('del_product',array('id'=>$product->id))}}" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                <a href="{{route('edit_product',array('id'=>$product->id))}}" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </div>
        </td>    
    </tr>
    @endforeach
</tbody>
  </table>
</div>
</div>

<div class="modal fade" id="buyer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{route('addProduct')}}" method="post">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Ener Name of Product"><br>
            <input type="number" name="price" class="form-control" placeholder="Ener Price of Product"><br>
            <input type="submit" name="submit" class="btn btn-primary mx-auto d-block" value="Submit">
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
@endsection