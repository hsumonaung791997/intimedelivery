@extends("layouts.admin")
@section('content')

<div class="row">

<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Order Verify Table</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<form action="{{URL::to('admin/order/verified/search')}}" method="get">
										@csrf 
									<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="date" class="form-control" name="date">
									</div>
									<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="text" name="name" placeholder="Order ID" class="form-control">										
									</div>
									<div class="col-md-2 col-sm-2 col-lg-2">
										<input type="submit" name="submit" value="Filter" class="btn btn-primary">
									</div>
									</form>
									</div>
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Order ID</th>
												<th>Order Date</th>
												<th>Description</th>
												<th>Total Amount</th>
												<th>Order Request</th>
												<th>Status</th>
												<th>Action</th>


											</tr>
										</thead>
										@if(isset($result_data))
										<?php $i=1; ?>
											@foreach($result_data as $res)
											<?php 
											$oid=$res->o_id;
											$o_id=DB::select("SELECT * FROM order_table where o_id='$oid'"); 
											?>
											@foreach($o_id as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->o_id}}</td>
												<td>{{$row->o_register_date}}</td>
												<td>{{$row->o_description}}</td>
												<td>{{$row->o_amount_total}}</td>
												<td><?php $user_id=$row->user_id;
												$res=DB::select("SELECT name FROM users where id='$user_id'");
													echo $res[0]->name; 	
												 ?></td>
												<td>
													@if($row->status==0)
													<?php echo "Pending"; ?>
													@elseif($row->status==1)
													<?php echo "Verified"; ?>
													@else
													<?php echo "Reject"; ?>
													@endif
												</td>
												<td>
   													

  															<div class="text-center"><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $row->o_id; ?>" class="dropdown-item" id="click_link" >Preview</a></div>
    														
													   	
												</td>

												</div>
											</tr>
											@endforeach
											
											@endforeach
										</tbody>
										@else
										<tbody>
											<?php $i=1; ?>
											@foreach($result as $res)
											<?php 
											$oid=$res->o_id;
											$o_id=DB::select("SELECT * FROM order_table where o_id='$oid'"); 
											?>
											@foreach($o_id as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->o_id}}</td>
												<td>{{$row->o_register_date}}</td>
												<td>{{$row->o_description}}</td>
												<td>{{$row->o_amount_total}}</td>
												<td><?php $user_id=$row->user_id;
												$res=DB::select("SELECT name FROM users where id='$user_id'");
													echo $res[0]->name; 	
												 ?></td>
												<td>
													@if($row->status==0)
													<?php echo "Pending"; ?>
													@elseif($row->status==1)
													<?php echo "Verified"; ?>
													@else
													<?php echo "Reject"; ?>
													@endif
												</td>
												<td>
											
													<div class="text-center"><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $row->o_id; ?>" class="dropdown-item" id="click_link" >Preview</a></div> 	
												</td>

												</div>
											</tr>
											@endforeach
											
											@endforeach
										</tbody>
										@endif
										
									</table>
									@if(isset($result_data))
									 {{ $result_data->appends(Request::except('/admin/route/list/table/search'))->setPath('/admin/route/list/table/search') }}

									@else
									 {{ $result->appends(Request::except('/admin/order/verified'))->setPath('/admin/order/verifiedt') }}
									 @endif
								</div>
							</div>
							<!-- END BASIC TABLE -->
						</div>
					</div>
@if(isset($result_data))
@foreach($result_data as $keys)
<div class="modal fade bd-example-modal-lg<?php echo $keys->o_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Product List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="modal-body">
     	<table class="table">
     		<thead>
     			<tr>
     			<td>Product ID</td>
      			<td>Weight</td>
      			<td>Expired Date</td>
      			<td>Quantity</td>
      			<td>Price Per Item</td>
      			<td>Amount</td>
     			</tr>
     		</thead>
     		<?php $oder_detail=DB::select("SELECT * FROM order_detail where o_id='$keys->o_id'"); ?>
     			<tbody>
     				@foreach($oder_detail as $i)
     				<tr>
     					<td>{{$i->p_id}}</td>
     					<td>{{$i->p_weight}}</td>
     					<td>{{$i->p_expired_date}}</td>
     					<td>{{$i->p_quantity}}</td>
     					<td>{{$i->p_price_per_item}}</td>
     					<td>{{$i->p_amount}}</td>
     				</tr>
     				@endforeach
     			</tbody>
     	</table>
     </div>
    </div>
  </div>
</div>
@endforeach
@else
@foreach($result as $keys)
<div class="modal fade bd-example-modal-lg<?php echo $keys->o_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Product List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="modal-body">
     	<table class="table">
     		<thead>
     			<tr>
     			<td>Product ID</td>
      			<td>Weight</td>
      			<td>Expired Date</td>
      			<td>Quantity</td>
      			<td>Price Per Item</td>
      			<td>Amount</td>
     			</tr>
     		</thead>
     		<?php $oder_detail=DB::select("SELECT * FROM order_detail where o_id='$keys->o_id'"); ?>
     			<tbody>
     				@foreach($oder_detail as $i)
     				<tr>
     					<td>{{$i->p_id}}</td>
     					<td>{{$i->p_weight}}</td>
     					<td>{{$i->p_expired_date}}</td>
     					<td>{{$i->p_quantity}}</td>
     					<td>{{$i->p_price_per_item}}</td>
     					<td>{{$i->p_amount}}</td>
     				</tr>
     				@endforeach
     			</tbody>
     	</table>
     </div>
    </div>
  </div>
</div>
@endforeach
@endif



<script type="text/javascript">

    $(function () {
          $("#click_link").on('click',function (e) {

          	e.preventDefault();
  
        });

    });
</script>

@endsection