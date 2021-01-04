@extends('layout.panel')
@section('content')
<div class="container">
    
<div class="row">
<div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
    <h3> {{$user->name}} Details </h3>
    @if(Session::has('success'))
    <p class="col-lg-4 col-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-success') }}">
    {{ Session::get('success') }} </p>
    @endif
    @if(Session::has('error'))
    <p class="col-lg-4 col-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-danger') }}">
        {{ Session::get('error') }}</p>
    @endif 
    @if ($errors->has('product')) <p style="color:red;">{{ $errors->first('product') }}</p> @endif 
    @if ($errors->has('id')) <p style="color:red;">{{ $errors->first('id') }}</p> @endif 
    @if ($errors->has('purchase_rate')) <p style="color:red;">{{ $errors->first('purchase_rate') }}</p> @endif 
    @if ($errors->has('dc')) <p style="color:red;">{{ $errors->first('dc') }}</p> @endif 
    @if ($errors->has('sale_rate')) <p style="color:red;">{{ $errors->first('sale_rate') }}</p> @endif 
</div>
<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
    <a href="#" class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#buyer"> Add Order </a>
</div>

</div> 

<div class="row text-center">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <button class="btn btn-success active_btn">Active Orders</button>
    <button class="btn btn-success complete_btn mx-2">Complete Orders</button>
    <button class="btn btn-success del_btn mx-2">Deleted Orders</button>
  </div>
</div>

<div class="active">
<div class="row mt-3">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <h4 class="text-success">Active Orders</h4>
    </div>
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
    <input class="form-control" id="myInput" type="text" placeholder="Search..">
</div>
</div>
<div class="table-responsive mt-3">
    <table class="table table-hover table-border">
        
<thead>
    <tr>
        <th> Date </th>
        <th> Product </th>    
        <th> Purchase Rate </th>    
        <th> Delivery Charges </th>    
        <th> Sale Rate </th>    
        <th> Profit </th>    
        <th> Action </th>    
    </tr>  
</thead>
<tbody id="myTable">
  
    @foreach ($active as $row)
    <tr>
        <td> {{$row->created_at}} </td>
        <td> {{$row->description}} </td>    
        <td> {{$row->purchase_rate}} </td>    
        <td> {{$row->dc}} </td>    
        <td> {{$row->sale_rate}} </td>    
        <td> {{$row->profit}} </td>    
        <td> 
            <div class="btn-group">
                <a href="{{route('del_order',array('id'=>$row->id))}}" title="Delete Order" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                <a href="{{route('complete_order',array('id'=>$row->id))}}" title="Completed Order" class="btn btn-primary"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
            </div>
        </td>    
    </tr>
    @endforeach
</tbody>
  </table>
</div>

</div>


<div class="complete" style="display:none;">
<div class="row mt-3">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <h4 class="text-success">Completed Orders</h4>
    </div>
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
    <input class="form-control" id="myInput1" type="text" placeholder="Search..">
</div>
</div>
<div class="table-responsive mt-3">
    <table class="table table-hover table-border">
        
<thead>
    <tr>
        <th> Date </th>
        <th> Product </th>    
        <th> Purchase Rate </th>    
        <th> Delivery Charges </th>    
        <th> Sale Rate </th>    
        <th> Profit </th>    
    </tr>  
</thead>
<tbody id="myTable1">
  
    @foreach ($completed as $row)
    <tr>
        <td> {{$row->created_at}} </td>
        <td> {{$row->description}} </td>    
        <td> {{$row->purchase_rate}} </td>    
        <td> {{$row->dc}} </td>    
        <td> {{$row->sale_rate}} </td>    
        <td> {{$row->profit}} </td>        
    </tr>
    @endforeach
</tbody>
  </table>
</div>
</div>



<div class="Delete" style="display:none;">
<div class="row mt-3">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <h4 class="text-success">Completed Orders</h4>
    </div>
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
    <input class="form-control" id="myInput1" type="text" placeholder="Search..">
</div>
</div>
<div class="table-responsive mt-3">
    <table class="table table-hover table-border">
        
<thead>
    <tr>
        <th> Date </th>
        <th> Product </th>    
        <th> Purchase Rate </th>    
        <th> Delivery Charges </th>    
        <th> Sale Rate </th>    
        <th> Profit </th>    
    </tr>  
</thead>
<tbody id="myTable1">
  
    @foreach ($del as $row)
    <tr>
        <td> {{$row->created_at}} </td>
        <td> {{$row->description}} </td>    
        <td> {{$row->purchase_rate}} </td>    
        <td> {{$row->dc}} </td>    
        <td> {{$row->sale_rate}} </td>    
        <td> {{$row->profit}} </td>        
    </tr>
    @endforeach
</tbody>
  </table>
</div>
</div>



</div>


<div class="modal fade" id="buyer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{route('order')}}" method="post">
            @csrf
            <input type="text" name="product" class="form-control" placeholder="Ener Product Details" required> <br>
            <input type="text" name="id" class="form-control" style="display: none;" value="{{$user->id}}" required>
            <input type="number" name="purchase_rate" class="form-control" placeholder="Ener Purchase Rate" required><br>
            <input type="number" name="dc" class="form-control" placeholder="Ener Delivery Charges" required><br>
            <input type="number" name="sale_rate" class="form-control" placeholder="Ener Sale Rate" required><br>
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
  
  
  <script>
    $(document).ready(function(){
      $("#myInput1").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable1 tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>

<script>
  $('.active_btn').click(function()
  {
    $('.active').attr('style','block');
    $('.complete').attr('style','none');
    $('.delete').attr('style','none');
  });
  </script>
  <script>
  
  $('.complete_btn').click(function()
  {
    $('.active').attr('style','none');
    $('.complete').attr('style','block');
    $('.delete').attr('style','none');
  });
  
</script>
  <script>
  $('.del_btn').click(function()
  {
    $('.active').attr('style','none');
    $('.complete').attr('style','none');
    $('.delete').attr('style','block');
  });
</script>

@endsection