@extends("layouts.admin")
@section('content')
<div class="row">
<div class="col-md-3">
		<!-- BASIC TABLE -->
		<div class="panel">
		<h4>Postman List</h4>
			<div class="panel-body">

			<table class="table">
				<?php $i=0; ?>
				@foreach($postman as $row)
				<?php $i++; ?>	
				<tr>
					<td>
					<a href="{{URL::to('warehouse/choose/postman/?postman='.$row->id)}}">
						<?php echo $i; ?></td>
					</a>
					<td>
					<a href="{{URL::to('warehouse/choose/postman/?postman='.$row->id)}}">
						{{$row->user_name}}
					</a>
					</td>
				</tr>
				@endforeach
			</table>	
			</div>
		</div>
	</div>
		@csrf
		<div class="col-sm-9 col-lg-9 col-md-9">
			<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel">
			<div class="panel-body">
				               
					                    
		<form action="{{URL::to('warehouse/postman/receive')}}" method="post">
                  @csrf
							@if(isset($choose_postman))
				@foreach($choose_postman as $cho_post)
								<div class="form-group">
					      <div class="col-lg-12">
					      	  <label for="basic" class="control-label"><span>ID : {{$cho_post->id}}</span></label>
					      	  
						 </div>
						  <div class="col-lg-12">
					      	  <label for="basic" class="control-label">Name : {{$cho_post->user_name}}</label>
					      </div>
					 	 <div class="col-lg-12">
					 	 	<input type="text" name="plan_id" autofocus="">
					      	<input type="submit" name="submit" class="btn btn-primary btn-sm" style="margin-top: -0.5%;">
					      </div>
					      </form>
					       <div class="col-lg-12">
					       	<input type="hidden" name="postman_id" value="{{$cho_post->id}}">
					      	  <table class="table"  style="font-size: 13px;">
					      	  	<thead>
		      	  					<th>No</th>
									<th>Product ID</th>
									<th>Product Name</th>
									<th>Product Type</th>
									<th>Product Size</th>
									<th>Vendor Name</th>
									<th>Quantity</th>
									<th>Action</th>
					      	  	</thead>
					      	  	<tbody>
					      	  		@if(isset($product_list))
									<?php $i=1; ?>

					      	  		@foreach($product_list as $p_list)
					      	  		<tr>
					      	  			<td><?php echo $i++ ?></td>
					      	  			<td>{{$p_list->p_id}}</td>
					      	  			<td>{{$p_list->product_name}}</td>
					      	  			<td>{{$p_list->product_type}}</td>
					      	  			<td>{{$p_list->product_size}}</td>
					      	  			<td>{{$p_list->product_vendor_name}}</td>
					      	  			<td>{{$p_list->out_qty}}</td>
					      	  			<td>
					      	  			 @foreach($choose_postman as $cho_post)
									    <a class="btn btn-danger btn-sm" href="{{URL::to('warehouse/postman/receive/cancel/'.$cho_post->id.'/'.$p_list->so_id.'/'.$p_list->plan_id)}}">Cancel</a>
									    @endforeach
					      	  			</td>
					      	  		</tr>
					      	  		@endforeach
					      	  		@endif
					      	  	</tbody>
					      	  </table>
					      </div>
					    </div>
				@endforeach
				@else
				<div class="form-group">
					      <div class="col-lg-12">
					      	  <label for="basic" class="control-label"><span>ID : </span></label>
						 </div>
						  <div class="col-lg-12">
					      	  <label for="basic" class="control-label">Name : </label>
					      </div>
					     
					       <div class="col-lg-12">
					      	  <table class="table"  style="font-size: 13px;">
					      	  	<thead>
		      	  				<th>No</th>
									<th>Product ID</th>
									<th>Product Name</th>
									<th>Product Type</th>
									<th>Product Size</th>
									<th>Vendor Name</th>
									<th>Quantity</th>
									<th>Action</th>
					      	  	</thead>
					      	  	<tbody>
					      	  		@if(isset($product_list))
					      	  		@foreach($product_list as $p_list)
					      	  		<tr>
					      	  			<td><?php echo $i++ ?></td>
					      	  			<td>{{$p_list->p_id}}</td>
					      	  			<td>{{$p_list->product_name}}</td>
					      	  			<td>{{$p_list->product_type}}</td>
					      	  			<td>{{$p_list->product_size}}</td>
					      	  			<td>{{$p_list->product_vendor_name}}</td>
					      	  			<td>{{$p_list->out_qty}}</td>
					      	  			
					      	  			<td>
									   @foreach($postman as $row)
									    <a class="btn btn-danger btn-sm" href="{{URL::to('warehouse/postman/receive/cancel/'.$row->id.'/'.$p_list->so_id.'/'.$p_list->plan_id)}}">Cancel</a>
									    @endforeach
					      	  			</td>
					      	  		</tr>
					      	  		@endforeach
					      	  		@endif
					      	  	</tbody>
					      	  </table>
					      </div>
					    </div>
				@endif
			</div>
		</div>
	</div>


</div>
</div>
	
</div>
<!-- <script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script> -->
<script type="text/javascript">

    $(function () {
          $("#state").on('click',function () {

            $state=$('#state').val();

            $.ajax({

            type : 'get',

            url : '{{URL::to('/order/entry/state')}}',

            data:{'state':$state},

            success:function(data){

            $('#township').html(data);
            }

            });
        });

    });
</script>

@endsection

