	@extends("layouts.admin")
@section('content')

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">HighWay Route List</h3>
								</div>
							
								<div class="panel-body">
				
									<table class="table">
										<thead>
											<tr>
											
												<th>No</th>
												<th>Customer Name</th>
												<th>Address</th>
												<th>Phone</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Qty</th>
												<th>Total Amount</th>
												<th>Reg: date</th>
												<th>Target Time</th>
												<th>Vendor Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@if(isset($data))
											<?php $i=1; ?>
											@foreach($data as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->r_name}}</td>
												<td>{{$row->address}},{{$row->s_name}},{{$row->t_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->p_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->qty}}</td>
												<td>{{$row->amount}}</td>
												<td><?php echo date("d-m-Y", strtotime($row->reg_date)); ?></td>
												<td>{{$row->target_date}}:{{$row->target_time}}</td>
												<td>{{$row->product_vendor_name}}</td>


												<td>
													<a class="btn btn-default" href="{{URL::to('admin/high/way/edit/'.$row->route_plan_id)}}">Edit</a>  
												</td>
											</tr>
											@endforeach	
											@else
											<?php $i=1; ?>
											@foreach($select as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->r_name}}</td>
												<td>{{$row->address}},{{$row->s_name}},{{$row->t_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->p_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->qty}}</td>
												<td>{{$row->amount}}</td>
												<td><?php echo date("d-m-Y", strtotime($row->reg_date)); ?></td>
												<td>{{$row->target_date}}:{{$row->target_time}}</td>
												<td>{{$row->product_vendor_name}}</td>


												<td>
													<a class="btn btn-default" href="{{URL::to('admin/high/way/edit/'.$row->route_plan_id)}}">Edit</a>  
												</td>
											</tr>
											@endforeach	
											@endif
										</tbody>
									</table>
									@if(isset($data))
									 {{ $data->appends(Request::except('/admin/route/list/request/search'))->setPath('/admin/route/list/request/search') }}

									@else
									 {{ $select->appends(Request::except('/admin/route/list/request'))->setPath('/admin/route/list/request') }}
									 @endif
								</div>

							</div>
							<!-- END BASIC TABLE -->
		</div>

</div>

@endsection
