@extends('layout.panel')
@section('content')
<div class="container">
    
<div class="row text-center">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <button class="btn btn-success active_btn mx-auto mt-5">Pending Orders</button>
    <button class="btn btn-success complete_btn mx-auto mt-5">Paid Orders</button>
    <a href="{{ route('createOrder',[$id]) }}" class="btn btn-primary complete_btn mx-auto mt-5">Create Orders</a>
    <button class="btn btn-primary mx-auto mt-5" onclick="Export()">Create PDF</button>
  </div>
</div>

<div class="topcorner d-none"></div>

<div class="active" style="">
    <div class="row mt-3">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <h4 class="text-success">Pending Orders</h4>
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
            <th> Buyer </th>    
            <th> Total </th>    
            <th> Paid </th>   
          </tr>  
      </thead>
      <tbody id="myTable">
        
          @foreach ($pending as $row)
          <tr>
              <td> {{$row->created_at}} </td>
              <td> {{$row->product->name}} </td>    
              <td> {{$row->user->name}} </td>    
              <td> Rs: {{$row->total}} </td>  
              <td> <input type="number" id="{{ $row->id }}" class="paid_val" value="{{$row->paid}}"> </td>    
          </tr>
          @endforeach
      </tbody>
        </table>
      </div>
</div>


<div class="complete" style="display:none;">
    <div class="row mt-3">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <h4 class="text-success">Paid Orders</h4>
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
            <th> Buyer </th>    
            <th> Total </th>    
            <th> Paid </th>    
          </tr>  
      </thead>
      <tbody id="myTable1">
        
          @foreach ($paid as $row)
          <tr>
            <td> {{$row->created_at}} </td>
            <td> {{$row->product->name}} </td>    
            <td> {{$row->user->name}} </td>    
            <td> Rs: {{$row->total}} </td>    
            <td> Rs: {{$row->paid}} </td>         
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
        <th> Buyer </th>    
        <th> Total </th>    
        <th> Paid </th>     
    </tr>  
</thead>
<tbody id="myTable2">
  
    @foreach ($deatils as $row)
    <tr>
        <td> {{$row->created_at}} </td>
        <td> {{$row->product->name}} </td>    
        <td> {{$row->user->name}} </td>    
        <td> Rs: {{$row->total}} </td>    
        <td> Rs: {{$row->paid}} </td>    
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
  $(".paid_val").keyup(function(){
    let val = $(this).val();
    let id = $(this).attr('id');


    $.ajax({
        method: 'GET',
        url: "{{ route('completeOrder') }}",
        data: {
            'val': val,
            'id':id
        },
        success: function(response) {
            if(response.error)
            {
              $('.topcorner').removeClass('d-none');
              $('.topcorner').addClass('bg-danger');
              $('.topcorner').text(response.error);
            }
            else
            {
              if(response.status == 1)
              {
                  $('#'+id).prop('disabled', true);;
              }
              $('.topcorner').removeClass('d-none');
              $('.topcorner').addClass('bg-success');
              $('.topcorner').text(response.success);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });





    
  });
</script>
  
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
  });
</script>
<script>
  $('.complete_btn').click(function()
  {
    $('.active').attr('style','display:none;');
    $('.complete').attr('style','display:block;');
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