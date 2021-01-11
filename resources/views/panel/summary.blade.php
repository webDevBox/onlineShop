@extends('layout.panel')
@section('content')
<div class="container">
    
<div class="row text-center">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <button class="btn btn-success active_btn mx-auto mt-5">Active Orders</button>
    <button class="btn btn-success complete_btn mx-auto mt-5">Complete Orders</button>
    <button class="btn btn-success del_btn mx-auto mt-5">Deleted Orders</button>
    <button class="btn btn-primary mx-auto mt-5" onclick="Export()">Create PDF</button>
  </div>
</div>

<div class="active" style="">
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
              <th> Buyer </th>    
              <th> Profit </th>    
              <th> Action </th>    
          </tr>  
      </thead>
      <tbody id="myTable">
        
          @foreach ($active as $row)
          @php
          $user=\App\Models\User::find($row->user);
      @endphp
          <tr>
              <td> {{$row->created_at}} </td>
              <td> {{$row->description}} </td>    
              <td> {{$row->purchase_rate}} </td>    
              <td> {{$row->dc}} </td>    
              <td> {{$row->sale_rate}} </td>    
              <td> {{$user->name}} </td>    
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
              <th> Buyer </th>    
              <th> Profit </th>    
          </tr>  
      </thead>
      <tbody id="myTable1">
        
          @foreach ($comp as $row)
          @php
          $user=\App\Models\User::find($row->user);
      @endphp
          <tr>
              <td> {{$row->created_at}} </td>
              <td> {{$row->description}} </td>    
              <td> {{$row->purchase_rate}} </td>    
              <td> {{$row->dc}} </td>    
              <td> {{$row->sale_rate}} </td>    
              <td> {{$user->name}} </td>    
              <td> {{$row->profit}} </td>        
          </tr>
          @endforeach
      </tbody>
        </table>
      </div>
</div>



<div class="delete" style="display:none;">
    <div class="row mt-3">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <h4 class="text-success">Deleted Orders</h4>
        </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
        <input class="form-control" id="myInput2" type="text" placeholder="Search..">
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
            <th> Buyer </th>    
            <th> Profit </th>    
        </tr>  
    </thead>
    <tbody id="myTable2">
      
        @foreach ($del as $row)
        @php
        $user=\App\Models\User::find($row->user);
    @endphp
        <tr>
            <td> {{$row->created_at}} </td>
            <td> {{$row->description}} </td>    
            <td> {{$row->purchase_rate}} </td>    
            <td> {{$row->dc}} </td>    
            <td> {{$row->sale_rate}} </td>    
            <td> {{$user->name}} </td>    
            <td> {{$row->profit}} </td>        
        </tr>
        @endforeach
    </tbody>
      </table>
    </div>
</div>



</div>

<div class="table-responsive mt-3" style="opacity: 0;">
    <table id="summ_table" class="table table-hover table-border">
<thead>
    <tr>
        <th> Date </th>
        <th> Product </th>    
        <th> Purchase Rate </th>    
        <th> Delivery Charges </th>    
        <th> Sale Rate </th>    
        <th> Buyer </th>    
        <th> Profit </th>    
    </tr>  
</thead>
<tbody id="myTable2">
  
    @foreach ($summ as $row)
    @php
        $user=\App\Models\User::find($row->user);
    @endphp
    <tr>
        <td> {{$row->created_at}} </td>
        <td> {{$row->description}} </td>    
        <td> {{$row->purchase_rate}} </td>    
        <td> {{$row->dc}} </td>    
        <td> {{$row->sale_rate}} </td>    
        <td> {{$user->name}} </td>    
        <td> {{$row->profit}} </td>        
    </tr>
    @endforeach
</tbody>
  </table>
</div>
@php
    $date=\Carbon\Carbon::today();
@endphp
<input type="text" name="" id="date" value="{{$date}}" style="display: none;">
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
      $("#myInput2").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable2 tr").filter(function() {
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
    $('.active').attr('style','display:block;');
    $('.complete').attr('style','display:none;');
    $('.delete').attr('style','display:none;');
  });
</script>
<script>
  $('.complete_btn').click(function()
  {
    $('.active').attr('style','display:none;');
    $('.complete').attr('style','display:block;');
    $('.delete').attr('style','display:none;');
  });
</script>
<script>
  $('.del_btn').click(function()
  {
    $('.active').attr('style','display:none;');
    $('.complete').attr('style','display:none;');
    $('.delete').attr('style','display:block;');
  });
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script type="text/javascript">
    function Export() {
    html2canvas(document.getElementById('summ_table'), {
    onrendered: function (canvas) {
    var data = canvas.toDataURL();
    var id = $('#date').val();
    var docDefinition = {
    content: [{
    image: data,
    width: 500
    }]
    };
    pdfMake.createPdf(docDefinition).download(id+".pdf");
    }
    });
    }
    </script>
@endsection