@extends("layouts.admin")
@section('content')
	<?php $total=0; 
	$sum=0; ?>
	<style type="text/css">
		#label_color{
			color: blue;
			font-size: 20px;
		}
	</style>
	<div class="row">
		<div class="col-md-3">
		<!-- BASIC TABLE -->
			<div class="panel">
				<h4>Postman state_list</h4>
				<div class="panel-body">
					<table class="table">
				<?php $i=0; ?>
				@foreach($postman as $row)
					<?php $i++; ?>	
					<tr>
						<td>
							<a href="{{URL::to('admin/choose/postman/?postman='.$row->id)}}">
								<?php echo $i; ?>
							</a>
						</td>
						<td>
							<a href="{{URL::to('admin/choose/postman/?postman='.$row->id)}}">
								{{$row->user_name}}
							</a>
						</td>
					</tr>
				@endforeach
					</table>	
				</div>
			</div>
		</div>

		<div class="col-sm-9 col-lg-9 col-md-9">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
						<div class="panel">
							<div class="panel-body">              
							@if(isset($choose_postman))
								@foreach($choose_postman as $cho_post)
								<div>
									<div class="form-group">
										<div class="col-lg-12">
										    <label for="basic" id="label_color" class="control-label"><span>ID : {{$cho_post->id}}</span></label>
										     <label for="basic" id="label_color" class="control-label pull-right">Total Route : <?php echo count($result); ?> </label>   	  
										</div>
										<div class="col-lg-12">
									      	<label for="basic" id="label_color" class="control-label">Name : {{$cho_post->user_name}}</label>
									    </div>
										<div class="col-lg-12">
									       	<input type="hidden" name="postman_id" value="{{$cho_post->id}}">
										    <div class="table-responsive">
										      	<table class="table"  style="font-size: 13px;">
										      	  	<thead>
										      	  		<th>#</th>
							      	  					<th>No</th>
							      	  					<th>Name</th>
														<th>Address</th>
														<th>Product name</th>
														<th>Deliver Date</th>
														<th>Target Date</th>
														<th>Qty</th>
														<th>Amount</th>
														<th>Action</th>
										      	  	</thead>
										      	  	<form action="{{asset('admin/assign/manage')}}" method="post">
										      	  		@csrf
										      	  		@if(isset($choose_postman))
															@foreach($choose_postman as $cho_post)
																       	<input type="hidden" name="postman_id" value="{{$cho_post->id}}">
															@endforeach
														@endif
											      	  	<tbody>
											      	  		<?php $i=0; ?>
											      	  		@foreach($result as $res)
										      	  				<tr>
										      	  			 		<?php	$i++; ?>
												      	  	 		<td>
													      	  	 		<label class="fancy-checkbox">
																			<input type="checkbox" value="{{$res->rp_id}}" name="route_plan_id[]">
																			<span></span>
																		</label>
												      	  	 		</td>
													      	  		<td><?php echo $i; ?></td>
													      	  		<td>{{$res->r_name}}</td>
													      	  		<td>{{$res->address}},{{$res->s_name}},{{$res->t_name}}</td>
													      	  		<td>{{$res->product_name}}</td>
													      	  		<td>{{$res->deliver_date}}</td>
													      	  		<td>{{$res->target_date}}</td>
													      	  		<td>{{$res->qty}}</td>
														      	  		<?php 
														      	  			$qty = $res->qty;
														      	  			$amount = $res->amount;
														      	  			$subtotal = $qty * $amount;
														      	  		?>
														      	  	<td>{{$subtotal}}</td>
													      	  		<td>
													      	  			@if($res->customer_confirm_status==1)
													      	  			<?php $status='danger'; ?>
													      	  			@elseif($res->customer_confirm_status==0)
													      	  			<?php $status='info'; ?>
													      	  			@elseif($res->customer_confirm_status==2)
													      	  			<?php $status='default'; ?>
													      	  			@endif
													      	  			<div class="btn-group">
																			 <button type="button" class="btn btn-<?php echo $status; ?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			    Action
																			 </button>
																		  	<div class="dropdown-menu">
																			  	<a class="dropdown-item" href="{{URL::to('accept/route/'.$res->pr_id.'/'.$res->rp_id)}}">Accept</a>
																			    <div class="dropdown-divider"></div>
																			    <a class="dropdown-item" href="{{URL::to('cancel/route/'.$res->pr_id.'/'.$res->rp_id)}}">Cancel</a>
																			    <div class="dropdown-divider"></div>
																			    <a class="dropdown-item" href="{{URL::to('admin/route/print/'.$res->pr_id.'/'.$res->rp_id)}}">Print</a>
																			    <div class="dropdown-divider"></div>
																			    <a class="dropdown-item" href="{{URL::to('admin/route/drop/'.$res->pr_id.'/'.$res->rp_id)}}">Drop</a>
																			    <div class="dropdown-divider"></div>
																			    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal{{$res->pr_id}}{{$res->rp_id}}">
																			    @if($res->customer_confirm_status==1)
																			    Preview
																			    @endif
																				</a>
																		  	</div>
																		</div>
													      	  		</td>
										      	  				</tr>
										      	  				<?php $total+=$subtotal; ?>
										      	  			@endforeach
										      	  		</tbody>
											      	  	<tfoot>
											      	  		<tr>
											      	  			<td>Total</td>
											      	  			<td colspan="7"></td>
											      	  			<td>{{$total}}</td>
											      	  			<td colspan="2"></td>
											      	  		</tr>
											      	  		<tr>
											      	  			@if(isset($result))
											      	  			<td><input type="submit" name="accept" value="Accept" class="btn btn-link btn-sm"></td>
											      	  			<td><input type="submit" name="cancel" value="Cancel" class="btn btn-link btn-sm"></td>
											      	  			<td><input type="submit" name="drop" value="Drop" class="btn btn-link btn-sm"></td>
											      	  			@endif
											      	  		</tr>
											      	  	</tfoot>
										      	  	</form>
										      	</table>
										    </div>
										</div>
									</div>
								</div>
								@endforeach
							@else
								<div class="form-group">
									<div class="col-lg-12">
										<label for="basic" class="control-label"><span>ID : </span></label>
										<label for="basic" class="control-label pull-right">Total Route : </label>
									</div>
									<div class="col-lg-12">
										<label for="basic" class="control-label">Name : </label>
									</div>
									<div class="col-lg-12 table-responsive">
										<table class="table"  style="font-size: 13px;">
										    <thead>
							      	  			<th>No</th>
							      	  			<th>Name</th>
												<th>Address</th>
												<th>Product name</th>
												<th>Order Date</th>
												<th>Target Date</th>
												<th>Qty</th>
												<th>Amount</th>
												<th>Action</th>
										    </thead>   	 
										</table>
									</div>
								</div>
							@endif
							</div>
						</div>
				</div>
				<form action="{{URL::to('admin/route/assign')}}" method="post">
					@csrf
					@if(isset($choose_postman))
						@foreach($choose_postman as $cho_post)
							<input type="hidden" name="postman_id" value="{{$cho_post->id}}">

						@endforeach
					@endif
					<div class="col-sm-12 col-md-12 col-lg-12">
						<div class="panel">
							<div class="panel-body">
								<div class="form-group">
									<div class="col-lg-12">
									    <div class="row">
									      	<div class="col-lg-3">
									      		<label for="basic" class="control-label">Select State</label>
									        	<select  class="form-control state" name="state" id="state" required="required">
										        	@if(isset($_GET['state']))
										        		<?php $stateid=$_GET['state'];
										        			$state_list=DB::select("SELECT * FROM state where id='$stateid'");
										        		 ?>
										        		 @foreach($state_list as $state_rows)
										        		 <option value="{{$state_rows->id}}" selected>{{$state_rows->name}}</option>
										        		 @endforeach

										        		 @foreach($state as $state_row)
										        		 <option value="{{$state_row->id}}">{{$state_row->name}}</option>
										        		 @endforeach
										        	@else
										        		@foreach($state as $state_row)
										        		 <option value="{{$state_row->id}}">{{$state_row->name}}</option>
										        		 @endforeach
										        	@endif
									        	</select>
									      	</div>
											<div class="col-lg-3">
									      		<label for="basic" class="control-label">Select Township</label>
									        	<select class="form-control" name="township" id="township" required="required">
										        	@if(isset($_GET['township']))
										        	<?php $townshipid=$_GET['township'];
										        			$township_list=DB::select("SELECT * FROM township where id='$townshipid'");
										        			$state_township=DB::select("SELECT * FROM township where state_id='$stateid'");
										        		 ?>
										        		 @foreach($township_list as $towship_row)
										        		 <option value="{{$towship_row->id}}" selected>{{$towship_row->name}}</option>
										        		 @endforeach

										        		  @foreach($state_township as $state_township_row)
										        		 <option value="{{$state_township_row->id}}">{{$state_township_row->name}}</option>
										        		 @endforeach
										        	@else
										        	 <?php $township_first=DB::select("SELECT * FROM township where state_id=1"); ?>
										        	 @foreach($township_first as $township_firsts)
										        	 <option value="{{$township_firsts->id}}">{{$township_firsts->name}}</option>
										        	 @endforeach
										        	@endif
									        	
									        	</select>
									      	</div>
									      	<div class="col-lg-3">
									      		<label for="basic" class="control-label">Target Date</label>
									        	<input type="date" name="target_date" id="target_date" class="form-control">
									      	</div>
									      	<div class="col-lg-2 mt-4" style="margin-top: 2.5%;">
									        	<input type="submit"  class="btn btn-primary" value="Assign">
									      	</div>
									  	</div>
									</div>
									<div class="col-lg-12">
									    <table class="table" style="font-size: 13px;">
									      	<thead>
									      	  	<th>Name</th>
												<th>Address</th>
												<th>Product name</th>
												<th>Order Date</th>
												<th>Target Date</th>
												<th>Qty</th>
												<th>Price per Item</th>
												<th>Total Amount</th>
												<th>Check</th>
									      	</thead>
									      	<tbody id="tbody">
												@foreach($data as $row)
													<tr>
														<td>{{$row->r_name}}</td>
														<td style="word-wrap: break-word;width: 30%;">{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
														<td>{{$row->product_name}}</td>
														<td><?php echo date('d-m-Y', strtotime($row->reg_date)); ?></td>
														<td>{{$row->target_date}}</td>
														<td>{{$row->qty}}</td>
														<td>{{$row->amount}}</td>
														<td><?=$row->qty*$row->amount?></td>
														<td>			
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
				</form>
			</div>
		</div>
	</div>

	@if(isset($result))
		@foreach($result as $res)
			@if($res->customer_confirm_status==1)
				<div class="modal fade" id="exampleModal{{$res->pr_id}}{{$res->rp_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  	<div class="modal-dialog" role="document">
					    <div class="modal-content">
					      	<div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
					      	</div>
					      	<div class="modal-body">
					        	{{$res->remark}}
					      	</div>
					      	<div class="modal-footer">
					        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					      	</div>
					    </div>
				  	</div>
				</div>
			@endif
		@endforeach
	@endif
	<script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>
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
	<script type="text/javascript">

	    $(function () {
	          $("#township,#target_date").on('change',function () {

	            $township=$('#township').val();
	            $target_date=$('#target_date').val();

	            $.ajax({

	            type : 'get',

	            url : '{{URL::to('/admin/township/route')}}',

	            data:{'township':$township, 'target_date' :$target_date},

	            success:function(data){

	            $('#tbody').html(data);
	            }

	            });
	        });

	    });
	</script>
@endsection
