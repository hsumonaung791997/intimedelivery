@extends("layouts.admin")
@section('content')

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Stock Return Product</h3>
								</div>
								<div class="panel-body">
						<form action="{{URL::to('warehouse/stock/return/search')}}" method="get">
							<?php 
						                    	if(isset($_GET['search'])){
														$name=$_GET['search'];						                    		
						                    	}else{
						                    		$name="";
						                    	}
						                    	if(isset($_GET['date'])){
														$date=$_GET['date'];						                    		
						                    	}else{
						                    		$date="";
						                    	}
						                    	 ?>
									<div class="col-md-12 col-lg-12 col-sm-12">
						                    <div class="col-md-3 col-lg-3 col-sm-3">
							                    <input type="text" class="form-control" name="search" placeholder="Search Product ID,Name,Type,Size AND Postman Name" value="{{$name}}">
							                  </div>
							                  <div class="col-md-3 col-lg-3 col-sm-3">
							                    <input type="date" class="form-control" name="date" value="{{$date}}">
							                  </div>
							                  <div class="col-md-2 col-sm-2 col-lg-2">
							                    <input type="submit" name="submit" value="Filter" class="btn btn-primary">
						                  </div>
					                  </div>
						</form>
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
												<th>In Qty</th>
												<th>Remark</th>
											</tr>
										</thead>
										<tbody>
											@if(isset($result_data))
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
												<td>{{$row->reason}}</td>
											</tr>
											@endforeach
											@else
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
												<td>{{$row->reason}}</td>
											</tr>
											@endforeach
											@endif
										</tbody>
									</table>
									@if(isset($result_data))
									 {{ $result_data->appends(Request::except('/warehouse/stock/return/search'))->setPath('/warehouse/stock/return/search') }}

									@else
									 {{ $result->appends(Request::except('/warehouse/stock/return'))->setPath('/warehouse/stock/return') }}
									 @endif
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>
</div>
@endsection
