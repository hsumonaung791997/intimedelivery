@extends("layouts.admin")
@section('content')

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Warehouse Stock Ledger</h3>
								</div>
								<div class="panel-body">
										<form action="{{URL::to('warehouse/stock/ledger/search')}}" method="get">
											<?php 
						                    	if(isset($_GET['name'])){
														$name=$_GET['name'];						                    		
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
							                    <input type="text" class="form-control" name="name" placeholder="Search Text" value="{{$name}}">
							                  </div>
							                  <div class="col-md-3 col-lg-3 col-sm-3">
							                    <input type="date" class="form-control" name="date" value="{{$date}}">
							                  </div>
							                 
							                  <div class="col-md-2 col-sm-2 col-lg-2">
							                    <input type="submit" name="filter" value="Filter" class="btn btn-primary">
							                    <input type="submit" name="print" value="Print" class="btn btn-success">

						                  </div>
					                  </div>
					                  </form>


									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Product Type</th>
												<th>Product Size</th>
												<th>Price Per Item</th>
												<th>In/Out Date</th>
												<th>In</th>
												<th>Out</th>
											</tr>
										</thead>
										<tbody>
											@if(isset($result))
											<?php $i=1; ?>
											@foreach($result as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->product_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->product_type}}</td>
												<td>{{$row->product_size}}</td>
												<td>{{$row->product_price_per_item}}</td>
												<td><?php $dates=$row->verified_date;
													echo date('d/m/Y H:i:s',strtotime($dates));
												 ?></td>
												<td>{{$row->stock_in}}</td>
												<td>{{$row->stock_out}}</td>
												<td></td>
											</tr>
											@endforeach
											@else
											<?php $i=1; ?>
											@foreach($result_data as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->product_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->product_type}}</td>
												<td>{{$row->product_size}}</td>
												<td>{{$row->product_price_per_item}}</td>
												<td><?php $dates=$row->verified_date;
													echo date('d/m/Y H:i:s',strtotime($dates));
												 ?></td>
												<td>{{$row->stock_in}}</td>
												<td>{{$row->stock_out}}</td>
												<td></td>
											</tr>
											@endforeach
											@endif
										</tbody>
									</table>
									@if(isset($result_data))
  										 {{ $result_data->appends(Request::except('/warehouse/stock/ledger/search'))->setPath('/warehouse/stock/ledger/search') }}
									@else
  										 {{ $result->appends(Request::except('/warehouse/stock/ledger'))->setPath('/warehouse/stock/ledger') }}

									@endif
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>

</div>
@endsection
