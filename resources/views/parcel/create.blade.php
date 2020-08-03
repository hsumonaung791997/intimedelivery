@extends("layouts.tables")
@section('content')
<style type="text/css">
  li{
    list-style: none;
  }
</style>
<script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>
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
<div class="col-sm-12 col-lg-12 col-md-12">
  <div class="row no-gutter">
<!-- Start register box -->
    <div class="col-sm-3 col-lg-3 col-md-3">
    <div class="panel panel-headline">
      @if(!isset($result))
      <form action="{{URL::to('product/save')}}" method="POST">
          @csrf
          <div class="panel-heading">
                  <h3 class="panel-title">Product Register</h3>
                </div>
                 <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
                <div class="panel-body">
                  <div class="form-group">
                  <label for="prroduct_id">{{ __('Product ID')}}</label>
            
                  <input type="text" name="p_id" class="form-control p_id" id="p_id"  autocomplete="off" placeholder="Enter Product ID" value="{{ old('p_id') }}" required>
                </div>
                <div class="form-group">
                  <label>{{ __('Product Name')}}</label>
            
                  <input type="text" name="p_name" class="form-control"  autocomplete="off" placeholder="Enter Product  Name" required value="{{ old('p_name') }}">
                </div>
                <div class="form-group">
                  <label>{{ __('Product Type')}}</label>
            
                  <input type="text" name="p_type" class="form-control" autocomplete="off" placeholder="Enter Product Type" required value="{{ old('p_type') }}">
                </div>
                <div class="form-group">
                   <label>{{ __('Product Size')}}</label>
            
                  <input type="text" name="p_size" class="form-control" autocomplete="off" placeholder="Enter Product Size" required value="{{ old('p_size') }}">
                </div>
                
                <div class="form-group">
                  <label>{{ __('Product Vendor Name')}}</label>
            
                  <input type="text" name="p_vendor_name" class="form-control"  autocomplete="off" placeholder="Enter Product Vendor Name" required value="{{ Auth::user()->name }}" onClick="this.select();">
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-sm"  autocomplete="off" placeholder="Enter Product Vendor Name" required>
                </div>
         </div>

</form>
@else
@foreach($result as $key)
<form action="{{URL::to('parcel/update')}}" method="POST">
          @csrf
          <div class="panel-heading">
                  <h3 class="panel-title">Product Edit</h3>
                </div>
                <div class="panel-body">
                  <input type="hidden" name="product_id" value="{{$key->product_id}}">
                   
                  <div class="form-group">
                  <label for="prroduct_id">{{ __('Product ID')}}</label>
            
                  <input type="text" name="p_id" class="form-control"  autocomplete="off" placeholder="Enter Product ID" value="{{$key->p_id}}"  required>
                </div>
                <div class="form-group">
                  <label>{{ __('Product Name')}}</label>
            
                  <input type="text" name="p_name" class="form-control"  autocomplete="off" placeholder="Enter Product  Name" value="{{$key->product_name}}" required>
                </div>
                <div class="form-group">
                  <label>{{ __('Product Type')}}</label>
            
                  <input type="text" name="p_type" class="form-control" autocomplete="off" placeholder="Enter Product Type" value="{{$key->product_type}}" required>
                </div>
                <div class="form-group">
                   <label>{{ __('Product Size')}}</label>
            
                  <input type="text" name="p_size" class="form-control" autocomplete="off" placeholder="Enter Product Size" value="{{$key->product_size}}" required>
                </div>
                
                <div class="form-group">
                  <label>{{ __('Product Vendor Name')}}</label>
            
                  <input type="text" name="p_vendor_name" class="form-control"  autocomplete="off" placeholder="Enter Product Vendor Name" value="{{$key->product_vendor_name}}" required>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-sm"  autocomplete="off" placeholder="Enter Product Vendor Name" required>
                </div>
         </div>

</form>
@endforeach
@endif
      </div>
    </div>
    <!-- End register box -->
    <!-- Start Table box -->
    <div class="col-sm-9 col-lg-9 col-md-9">
      <div class="panel panel-scrolling">
    <div class="panel panel-headline">
          <div class="panel-heading">
                  <h3 class="panel-title">Product List </h3>
                  <a href="{{URL::to('export/all')}}" class="btn btn-primary btn-sm">Export</a>

                </div>
                <div class="panel-body">
                  <div class="col-sm-3 col-lg-3 col-md-3">
                    <input type="text" id="myInput" class="form-control" placeholder="Search ....">
                  </div>
              <div class="table">
                <table class="table">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Type</th>
                    <th>Product Size</th>
                    <th>Product Vendor Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="myTable">
                    <?php $i=1; ?>
                    @foreach($data as $row)
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td>{{$row->p_id}}</td>
                      <td>{{$row->product_name}}</td>
                      <td>{{$row->product_type}}</td>
                      <td>{{$row->product_size}}</td>
                      <td>{{$row->product_vendor_name}}</td>
                      <td>
                        <div class="dropdown">
                              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Modify
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="text-center"><a class="dropdown-item" href="{{URL::to('/parcel/edit/'.$row->product_id)}}" >Edit</a></div>
                                <div class="text-center"><a class="dropdown-item" href="{{URL::to('/parcel/delete/'.$row->product_id)}}" >Delete</a></div>
                              </div>
                          </div>   
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>    
         </div>
      </div>
    </div>
    </div>
    <!-- End register box -->
   </div> 
</div>
<div class="col-sm-12 col-lg-12 col-md-12">
           <p id="result" style="color: red;"></p>
  
</div>
     <div class="col-md-8 col-lg-8 col-sm-8">
                       <!-- TIMELINE -->
           <!--    <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Convert Route </h3>
                </div>
<form method="post" enctype="multipart/form-data" action="{{ url('/convert/route') }}">
                    @csrf
                <div class="panel-body">
                  <div class="col-sm-12 col-lg-12 col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                   
                    <div class="form-group">
                      <input id="form_lastname" type="file" name="file" class="form-control" >
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                   <div class="col-md-6">
                    <div class="form-group">
                      <input  type="submit" class="btn btn-primary">
                    </div>
                  </div>
                  </form>
                  
                    </div> -->
                    
                  </div>
<script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">

    $(function () {
          $("#p_id").on('keyup',function () {

            $state=$('#p_id').val();

            $.ajax({

            type : 'get',

            url : '{{URL::to('/auto/suggest')}}',

            data:{'p_id':$state},

            success:function(data){

            $('#result').html(data);
            }

            });
        });

    });
</script>
@endsection