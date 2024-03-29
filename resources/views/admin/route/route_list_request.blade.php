	@extends("layouts.admin")
@section('content')

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Route List Request</h3>
								</div>
							
								<div class="panel-body">
				<form action="{{URL::to('admin/route/list/request/search')}}" method="get">
					<div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="col-md-3 col-lg-3 col-sm-3">
                    <input type="text" class="form-control" name="search" placeholder="Search Text">
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-3">
                    <input type="date" class="form-control" name="date">
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-3">
                    	<?php $state=DB::select("SELECT * FROM state ORDER BY id DESC"); ?>
                    <select class="form-control" name="state">
                    	<option value="">Select State</option>
                      @foreach($state as $sta)
                      <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>
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
												<td>{{$row->address}},{{$row->s_name}},{{$row->t_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->p_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->qty}}</td>
												<!-- <?php 
													$qty = $row->qty;
													$amount = $row->amount;
													$total = $qty * $amount;
												?> -->
												<td>{{$row->amount}}</td>
												<td><?php echo date("d-m-Y", strtotime($row->reg_date)); ?></td>
												<td>{{$row->target_date}}:{{$row->target_time}}</td>
												<td>{{$row->product_vendor_name}}</td>


												<td>
													<a class="btn btn-default" href="{{URL::to('admin/route/edit/'.$row->route_plan_id)}}">Update and Verify</a>  
												</td>
											</tr>
											@endforeach	
											@else
											<?php $i=1; ?>
											@foreach($select as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->address}},{{$row->s_name}},{{$row->t_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->p_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->qty}}</td>
												<?php 
													$fqty = $row->qty;
													$famount = $row->amount;
													$ftotal = $fqty* $famount;
												?>
												<td>{{$ftotal}}</td>
												<td><?php echo date("d-m-Y", strtotime($row->reg_date)); ?></td>
												<td>{{$row->target_date}}:{{$row->target_time}}</td>
												<td>{{$row->product_vendor_name}}</td>


												<td>
													<a class="btn btn-default" href="{{URL::to('admin/route/edit/'.$row->route_plan_id)}}">Update and Verify</a>  
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
