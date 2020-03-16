	@extends("layouts.admin")
@section('content')

<div class="row">

<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Route List (Assigned)</h3>
								</div>
								<form action="{{URL::to('admin/assigned/route/search')}}" method="get">
									@csrf
									<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="text" class="form-control" name="search" placeholder="Search Text">
									</div>
									<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="date" class="form-control" name="date">
									</div>
									<div class="col-md-2 col-sm-2 col-lg-2">
										<input type="submit" name="submit" value="Filter" class="btn btn-primary">
									</div>
							</form>

								<div class="panel-body">
									
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Address</th>
												<th>Phone</th>
												<th>Product Name</th>
												<th>Qty</th>
												<th>Amount</th>
												<th>Total Amount</th>
												<th>Reg: date</th>
												<th>Target Time</th>
												<th>Vendor Name</th>
												<th>Postman</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@if(!isset($select_result))
											<?php $i=1; ?>
											@foreach($select as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->qty}}</td>
												<td>{{$row->amount}}</td>
												<td>{{$row->qty*$row->amount}}</td>
												<td>{{$row->reg_date}}</td>
												<td>{{$row->target_date}}</td>
												<td>{{$row->vendor_name}}</td>
												<td>{{$row->postman_name}}</td>
												<td>
													<?php
													$route_plan_id=$row->route_plan_id; 
													$result=DB::select("SELECT * FROM route_planning where plan_id='$route_plan_id'"); 
													if(count($result)>0){
														echo "Updated";
													}else{
														echo "Pending";
													}
													?>
												</td>
												<td>
													<a href="{{URL::to('admin/route/plan/edit/'.$row->route_plan_id)}}" class="dropdown-item" id="click_link" >Edit</a> 
												</td>
											</tr>
											@endforeach
											@else
											<?php $i=1; ?>
											@foreach($select_result as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->qty}}</td>
												<td>{{$row->amount}}</td>
												<td>{{$row->qty*$row->amount}}</td>
												<td>{{$row->reg_date}}</td>
												<td>{{$row->target_date}}</td>
												<td>{{$row->vendor_name}}</td>
												<td>{{$row->postman_name}}</td>
												<td>
													<?php
													$route_plan_id=$row->route_plan_id; 
													$result=DB::select("SELECT * FROM route_planning where plan_id='$route_plan_id'"); 
													if(count($result)>0){
														echo "Updated";
													}else{
														echo "Pending";
													}
													?>
												</td>
												<td>
													<a href="{{URL::to('admin/route/plan/edit/'.$row->route_plan_id)}}" class="dropdown-item" id="click_link" >Edit</a> 
												</td>
											</tr>
											@endforeach

											@endif
											
										</tbody>
									</table>
									@if(isset($select_result))
									 {{ $select_result->appends(Request::except('/admin/route/assigned'))->setPath('/admin/route/assigned') }}
									 @else
									  {{ $select->appends(Request::except('/admin/route/assigned'))->setPath('/admin/route/assigned') }}
									 @endif
								</div>

							</div>
							<!-- END BASIC TABLE -->
		</div>

</div>

@endsection
