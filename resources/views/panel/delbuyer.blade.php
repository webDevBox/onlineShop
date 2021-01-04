@extends('layout.panel')
@section('content')
<div class="container">
    <div class="table-responsive">
<table class="table table-hover table-border">
<div class="row">
<div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
    <h3> All Users </h3>
    @if(Session::has('success'))
    <p class="col-lg-4 col-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-success') }}">
    {{ Session::get('success') }} </p>
    @endif
    @if(Session::has('error'))
    <p class="col-lg-4 col-md-4 col-sm-4 col-xs-4 alert text-center {{ Session::get('alert-class', 'alert-danger') }}">
        {{ Session::get('error') }}</p>
    @endif 
   
</div>
<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 my-3">
    <input class="form-control" id="myInput" type="text" placeholder="Search..">
</div>

</div> 
<thead>
    <tr>
        <th> Name </th>
        <th> Phone </th>    
        <th> Added </th>    
        <th> Action </th>    
    </tr>  
</thead>
<tbody id="myTable">
  
    @foreach ($buyer as $row)
    <tr>
        <td> {{$row->name}} </td>
        <td> {{$row->email}} </td>    
        <td> {{$row->created_at}} </td>    
        <td> 
            <div class="btn-group">
                <a href="{{route('active_user',array('id'=>$row->id))}}" title="Active" class="btn btn-primary"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
            </div>
        </td>    
    </tr>
    @endforeach
</tbody>
  </table>
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
@endsection