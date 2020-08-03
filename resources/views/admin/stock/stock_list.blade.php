@extends('layouts.admin')
@section('content')

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Stock Balance</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<form action="{{URL::to('admin/stock/list/search')}}" method="get">
										@csrf 
										<?php 
						                    	if(isset($_GET['search'])){
														$name=$_GET['search'];						                    		
						                    	}else{
						                    		$name="";
						                    	}
						                    	
						                    	 ?>
										<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="text" class="form-control" name="search" placeholder="Search by Product ID,Name,Type, and Size" value="{{$name}}">
									</div>
									
									
										<input type="submit"  value="Filter" name="filter" class="btn btn-primary">
										<input type="submit"  value="Print" name="print" class="btn btn-success">

									
									</form>
									</div>
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Product Type</th>
												<th>Product Size</th>
												<th>Price Per Item</th>
												<th>In Qty</th>
												<th>Out Qty</th>
												<th>Balance</th>
												<th>Show QR</th>
											</tr>
										</thead>
										<tbody>
											@if(isset($result_data))
											<?php $i=1; ?>
											@foreach($result_data as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->product_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->product_type}}</td>
												<td>{{$row->product_size}}</td>
												<td>{{$row->price_per_item}}</td>
												
												<td>{{$row->total_stock_in}}</td>
												<td>{{$row->total_stock_out}}</td>
												<td>{{$row->total_stock_in-$row->total_stock_out}}</td>
												<td><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalLong<?php echo $row->product_id; ?>">
													  Show QR
													</a> </td>
											</tr>
											@endforeach
											@else
											<?php $i=1; ?>
											@foreach($result as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->product_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->product_type}}</td>
												<td>{{$row->product_size}}</td>
												<td>{{$row->price_per_item}}</td>
												
												<td>{{$row->total_stock_in}}</td>
												<td>{{$row->total_stock_out}}</td>
												<td>{{$row->total_stock_in-$row->total_stock_out}}</td>
												<td><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalLong<?php echo $row->product_id; ?>">
													  Show QR
													</a> </td>
											</tr>
											@endforeach
											@endif
										</tbody>
									</table>
									@if(isset($result_data))
									 {{ $result_data->appends(Request::except('/admin/stock/list/search'))->setPath('/admin/stock/list/search') }}

									@else
									 {{ $result->appends(Request::except('/admin/stock/list'))->setPath('/admin/stock/list') }}
									 @endif
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>
</div>
@if(isset($result_data))
@foreach($result_data as $row)
<div class="modal fade" id="exampleModalLong<?php echo $row->product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered  modal-sm" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">QR Code</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						       <?php echo QrCode::size(280)->generate("$row->product_id"); ?>
						      </div>
						      <div class="modal-footer">
						      	<input type="button" value="Print this page" onClick="window.print()">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      
						      </div>
						    </div>
						  </div>
						</div>
						@endforeach

@else
@foreach($result as $row)
<div class="modal fade" id="exampleModalLong<?php echo $row->product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered  modal-sm" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">QR Code</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						       <?php echo QrCode::size(280)->generate("$row->product_id"); ?>
						      </div>
						      <div class="modal-footer">
						      	<a class="btn btn-default" href="{{URL::to('qr/print/?qr_code_no='.$row->product_id)}}">Print</a>
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      
						      </div>
						    </div>
						  </div>
						</div>
						@endforeach

@endif


@endsection
