@extends('layouts.tables')
@section('content')

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Contact Issue</h3>
								</div>
								<div class="panel-body">
									<div class="row">
							<div><a href="{{URL::to('contact/issue/export')}}" class="btn btn-danger btn-sm">Export</a></div>
									<div class="tabele-responsive">	
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Customer </th>
												<th>Phone No.</th>
												<th>Address</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Product Type</th>
												<th>Qty</th>
												<th>Amount</th>
												<th>Target Date</th>
												<th>Reg Date</th>
												<th>Remark</th>
												<th>Vendor</th>
											</tr>
										</thead>
										<tbody>
							
											<?php $i=1; ?>
											@foreach($result as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->r_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
												<td>{{$row->p_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->product_type}}</td>
												<td>{{$row->quantity}}</td>
												<td>{{$row->amount}}</td>
												<td>{{$row->target_date}}</td>
												<td><?php $date=$row->reg_date;
												echo date("Y-m-d",strtotime($date));
												 ?></td>
												<td>{{$row->remark}}</td>
												<td>{{$row->name}}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									</div>
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>
</div>

@endsection
