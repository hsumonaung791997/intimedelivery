@extends("layouts.admin")
@section('content')
  <link rel="stylesheet" href="{{URL::to('/datepicker/css/datepicker.css')}}">
<div class="row">
            <div class="col-md-12">
              @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
  <div class="col-md-3">
    
              <!-- BASIC TABLE -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Staff Payment</h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12" style="margin-top: 5%;">
                      
        <div class="form-group">
        <div id="image-preview">
                <img src="{{URL::to('images.png')}}" class="mt-2" id="profile-img-tag" width="100%;">
                <br>
                  <div class="form-group" style="margin-top: 2%;">
                    <label>Name</label>
                    <input type="text" name="name" readonly="true" value="Kyaw Kyaw" class="form-control">
                  </div>
                  <div class="form-group" style="margin-top: 2%;">
                    <label>Phone One</label>
                    <input type="text" name="name" readonly="true" value="0912345678" class="form-control">
                  </div>
                  <div class="form-group" style="margin-top: 2%;">
                    <label>Phone Two</label>
                    <input type="text" name="name" readonly="true" value="0912345678" class="form-control">
                  </div>
                  <div class="form-group" style="margin-top: 2%;">
                    <label>Month</label>
                    <input type="text" name="payment_month" id="datepicker" value="<?php echo date('m-Y'); ?>" class="form-control">
                  </div>
                  <div class="form-group" style="margin-top: 2%;">
                    <label>Salary</label>
                    <input type="text" name="salary"  class="form-control">
                  </div>
              
                    <input type="submit" name="submit"  class="btn btn-primary">
              </div>
            </div>
                    </div>
          
  
              </div>
              </div>
              </div>
  </div>

  <div class="col-md-9">
    
              <!-- BASIC TABLE -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Staff Payment</h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        
                  <div class="form-group col-md-3">
                    <label>Choose Month</label>
                    <input type="text" name="name"   class="form-control" value="<?php echo date('m-Y'); ?>" id="datepicker">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Select use type</label>
                    <select class="form-control" name="type">
                      <option>All</option>
                      <option>Advance</option>
                      <option>Saving</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3" >
                    <label>Amount</label>
                    <input type="text" name="name" placeholder="Amount" class="form-control">
                  </div>
                <div class="form-group col-md-12" >
                    <label></label>
                    <input type="submit" name="name" value="Update" class="btn btn-primary">

                    <input type="submit" name="name" value="Search" class="btn btn-primary">
                  </div>
                      </div>

            </div>
          
  
              </div>
              </div>
              </div>
  </div>

  </div>            
              <!-- END BASIC TABLE -->
</div>
</div>
  <script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>

<script type="text/javascript" src="{{URL::to('/datepicker/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
  $("#datepicker").datepicker( {
    format: "mm-yyyy",
    viewMode: "months", 
    minViewMode: "months"
});
</script>
 
@endsection