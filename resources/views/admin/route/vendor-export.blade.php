@extends("layouts.admin")
@section('content')

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Export Vendor Data</h3>
								</div>
							
								<div class="panel-body">
				<form action="{{URL::to('admin/route/list/vendor/export')}}" method="get">
					<div class="col-md-12 col-lg-12 col-sm-12">
	                    <div class="col-md-3 col-lg-3 col-sm-3">
	                    	<input type="text" class="form-control" name="vendor_name" placeholder="Search Vendor Name">
	                    	@if($errors->has('vendor_name'))
                                <span class="alert text-danger">{{$errors->first('vendor_name')}}</span>
                            @endif
	                  	</div>
		                <div class="col-md-3 col-lg-3 col-sm-3">
		                    <input type="date" class="form-control" name="start_date">
		                    @if($errors->has('start_date'))
                                <span class="alert text-danger">{{$errors->first('start_date')}}</span>
                            @endif
		                </div>
		                <div class="col-md-3 col-lg-3 col-sm-3">
		                    <input type="date" class="form-control" name="end_date">
		                    @if($errors->has('end_date'))
                                <span class="alert text-danger">{{$errors->first('end_date')}}</span>
                            @endif
		                </div>
		                <div class="col-md-2 col-sm-2 col-lg-2">
		                    <input type="submit" name="submit" value="Export" class="btn btn-primary">
		                </div>
                  	</div>
                  	 
                  	<br><br>
             
									<table class="table">
										<thead>
											<tr>
											
												<th>No</th>
												<th>Address</th>
												<th>Phone</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Qty</th>
												<th>Price per Item</th>
												<th>Total Amount</th>
												<th>Vendor Name</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; ?>
											@foreach($select as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->address}},{{$row->s_name}},{{$row->t_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->p_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->qty}}</td>
												<td>{{ $row->amount }}</td>
												<?php 
													$fqty = $row->qty;
													$famount = $row->amount;
													$ftotal = $fqty* $famount;
												?>
												<td>{{$ftotal}}</td>
												<td>{{$row->product_vendor_name}}</td>
											</tr>
											@endforeach	
											 
										</tbody>
									</table>

									   </form>
									 
									 {{ $select->appends(Request::except('/admin/route/list/vendor'))->setPath('/admin/route/list/vendor') }}
									 
								</div>

							</div>
							<!-- END BASIC TABLE -->
		</div>

</div>

@endsection
