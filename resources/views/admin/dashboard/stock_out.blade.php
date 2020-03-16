@extends("layouts.admin")
@section('content')

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Stock Outgoing Product</h3>
								</div>
								<div class="panel-body">
									<a href="{{URL::to('admin/dashboard/stock_out/export')}}" class="btn btn-primary">Print</a>
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Postman</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Product Type</th>
												<th>Product Size</th>
												<th>Price Per Item</th>
												<th>Date</th>
												<th>Out Qty</th>
											</tr>
										</thead>
										<tbody>
											@if(isset($result))
											<?php $i=1; ?>
											@foreach($result as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->user_name}}</td>
												<td>{{$row->product_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->product_type}}</td>
												<td>{{$row->product_size}}</td>
												<td>{{$row->price_per_item}}</td>
												<td><?php $dates=$row->incoming_date;
													echo date('d/m/Y H:i:s',strtotime($dates));
												 ?></td>
												<td>{{$row->in_qty}}</td>
											</tr>
											@endforeach
											@else
											<?php $i=1; ?>
											@foreach($result_data as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->user_name}}</td>
												<td>{{$row->product_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->product_type}}</td>
												<td>{{$row->product_size}}</td>
												<td>{{$row->price_per_item}}</td>
												<td><?php $dates=$row->incoming_date;
													echo date('d/m/Y H:i:s',strtotime($dates));
												 ?></td>
												<td>{{$row->in_qty}}</td>
											</tr>
											@endforeach
											@endif
										</tbody>
									</table>
								
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>
</div>
@endsection
