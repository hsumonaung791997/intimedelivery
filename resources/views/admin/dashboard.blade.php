@extends('layouts.admin')
@section('content')

				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Admin Dashboard</h3>
							<p class="panel-subtitle"><?php echo date("d D / M / Y"); ?></p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-file-text"></i></span>
										<a href="{{URL::to('admin/order/list')}}">
										<p>
											<span class="number"><?php echo $order[0]->order_count; ?></span>
											<span class="title">Record order is active arrival</span>
										</p>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-map"></i></span>
										<p>
											<!-- admin/route/list/request -->
										<a href="{{URL::to('admin/route/list/request')}}">	
											<span class="number"><?php echo $route_list[0]->route_count;?></span>
											<span class="title">Route need Approval OR Reject</span>
										</a>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-angle-right"></i> <i class="fa fa-shopping-bag"></i></span>
										<a href="{{URL::to('admin/dashboard/stock_in')}}">
										<p>
											<span class="number"><?php if($stock_in[0]->stock_in_count==0){
												echo 0;
											}else{
												echo $stock_in[0]->stock_in_count;
											} ?></span>
											<span class="title">Received Quantity For Today</span>
										</p>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-angle-left"></i> <i class="fa fa-shopping-bag"></i></span>
										<a href="{{URL::to('admin/dashboard/stock_out')}}">
										<p>
											<span class="number"><?php if($stock_out[0]->stock_out_count==0){
												echo 0;
											}else{
												echo $stock_out[0]->stock_out_count;
											} ?></span>
											<span class="title">Outgoing Quantity For Today</span>
										</p>
									</a>
									</div>
								</div>
								
							</div>
						
						</div>
					</div>
					<!-- END OVERVIEW -->
					<div class="row">
						<div class="col-md-4">
							<!-- RECENT PURCHASES -->
							<div class="panel panel-scrolling">
								<div class="panel-heading">
									<h3 class="panel-title">Postman Status</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>ID</th>
												<th>Name</th>
												<th>Phone No</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; ?>
											@foreach($postman as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->id}}</td>
												<td>{{$row->user_name}}</td>
												<td>{{$row->ph_one}}</td>
												<td>
													@if($row->status==1)
													<a href="{{URL::to('admin/map/search?postman_id='.$row->id)}}">
													<span class="label label-success">On Going</span>
													</a>
													@else
													<span class="label label-danger">Stopping</span>
													@endif
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								
							</div>
							<!-- END RECENT PURCHASES -->
						</div>

						@if(isset($noti_date))
						<div class="col-md-8">
							<!-- MULTI CHARTS -->
							<div class="panel panel-scrolling">
								<div class="panel-heading">
									<h3 class="panel-title">Daily Route Alert</h3>
									<div class="right">
										<a href="{{URL::to('admin/target/date/route/export')}}"><span class="label label-success">Print</span></a>
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>

									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Quantity</th>
												<th>Price</th>
												<th>Address</th>
												<th>Vendor</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; ?>
											@foreach($noti_date as $key)
											<tr>
												<td>{{$key->p_id}}</td>
												<td>{{$key->product_name}}</td>
												<td>{{$key->quantity}}</td>
												<td>{{$key->amount}}</td>
												<td>{{$key->address}},{{$key->t_name}},{{$key->s_name}}</td>
												<td>{{$key->product_vendor_name}}</td>
												
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<!-- END MULTI CHARTS -->
						</div>

						@endif
					</div>
				</div>
@endsection