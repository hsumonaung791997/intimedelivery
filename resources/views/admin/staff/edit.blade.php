@extends("layouts.admin")
@section('content')
<style type="text/css">
	#image-preview {
  width: 60%;
  height: 275px;
  position: relative;
  overflow: hidden;
  background-color: #ffffff;
  color: #ecf0f1;
}
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
#image-preview input {
  line-height: 200px;
  font-size: 200px;
  position: absolute;
   cursor: pointer;
  opacity: 0;
  z-index: 10;
}
#image-preview label {
  position: absolute;
  z-index: 5;
  opacity: 0.8;
  cursor: pointer;
  background-color: #bdc3c7;
  width: 200px;
  height: 50px;
  font-size: 20px;
  line-height: 50px;
  text-transform: uppercase;
  top: 0;
  left: 0;
  right: 0;
  cursor: pointer;
  bottom: 0;
  margin: auto;
  text-align: center;
}

</style>
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
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Staff Update</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-4" style="margin-top: 5%;">
											
				@foreach($edit as $row)

				<form method="post" action="{{asset('admin/postman/update/'.$row->id)}}" class="form-signin" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
				@csrf
				@method('get')
				<div class="form-group">
				<div id="image-preview">
                <label for="image-upload" id="image-label image-preview label" style="color: white;cursor: pointer;">Choose  Photo</label>
                <input type="file" name="front_image" id="profile-img">
                <img src="{{URL::to('file/photo/'.$row->photo)}}" class="mt-2" id="profile-img-tag" width="100%;">
                  
              </div>
          	</div>
										</div>
										<div class="col-md-4">
											<input type="hidden" name="images" value="{{$row->photo}}">
							  <div class="form-group">
							    <label for="exampleInputEmail1">{{ __('Username')}}</label>
						
							    <input type="text" name="username" class="form-control" value="{{$row->user_name}}">
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">{{ __('Nick Name')}}</label>
							  

							    <input type="text" name="delivery_name" class="form-control" value="{{$row->delivery_name}}">
							   

							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">{{ __('Staff N.R.C')}}</label>
							   

							    <input type="text" name="delivery_nrc" class="form-control" value="{{$row->delivery_nrc}}">
							   
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">{{ __('Res: Date')}}</label>
							  
							    <input type="date" name="registration_date" class="form-control" value="<?php  $date=$row->registration_date; 
							    $dates=strtotime($date);
							    echo date("Y-m-d", $dates); 
							    ?>">
							   
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1">{{ __('Reg: Date')}}</label>
								
							    <input type="date" name="register_date" class="form-control" value="<?php  $date=$row->register_date; 
							    $dates=strtotime($date);
							    echo date("Y-m-d", $dates); 
							    ?>">
							 

							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1">{{ __('D.O.B')}}</label>

							    <input type="date" name="date_of_birth" class="form-control" value="{{$row->date_of_birth}}">
							  </div>
							  <div class="form-check">
							    
							    
							  </div>
							  <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
							
							</div>
							<div class="col-md-4">
											
						
								
							  <div class="form-group">
							    <label for="exampleInputEmail1">{{ __('Phone No.1')}}</label>

							    <input type="text" name="ph_one" class="form-control" value="{{$row->ph_one}}">
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">{{ __('Phone No.2')}}</label>
				

							    <input type="text" name="ph_two" class="form-control" value="{{$row->ph_two}}">
							    
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">{{ __('Address')}}</label>
						

							    <input type="text" name="address" class="form-control" value="{{$row->address}}">
							   
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">{{ __('Employment Date')}}</label>
						

							    <input type="date" name="employment_date" class="form-control" value="<?php  $date=$row->employment_date; 
							    $dates=strtotime($date);
							    echo date("Y-m-d", $dates); 
							    ?>">
							  </div>
							  
							 
							</form>
							@endforeach
							</div>
							</div>
							</div>
							</div>
							<!-- END BASIC TABLE -->
</div>
</div>

	<script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>
       <script type="text/javascript">

            function readURL(input) {

                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    

                    reader.onload = function (e) {

                        $('#profile-img-tag').attr('src', e.target.result);

                    }

                    reader.readAsDataURL(input.files[0]);

                }

            }

            $("#profile-img").change(function(){

                readURL(this);

            });

        </script>
@endsection