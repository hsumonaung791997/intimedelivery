@extends("layouts.tables")
@section('content')
<?php $i=0; ?>
<div class="row">

<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Route List</h3>
								</div>
								<div class="panel-body">
									<form action="{{URL::to('route/list/search')}}" method="get">
										<?php 
						                    	if(isset($_GET['name'])){
														$name=$_GET['name'];						                    		
						                    	}else{
						                    		$name="";
						                    	}
						                    	if(isset($_GET['date'])){
														$date=$_GET['date'];						                    		
						                    	}else{
						                    		$date=date("Y-m-d");
						                    	}

						                    	 ?>
									
									<div class="row">
										<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d',strtotime($date)); ?>">
									</div>
									
									<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="text" name="name" placeholder="Search" class="form-control" value="{{$name}}">										
									</div>	
									<div class="col-sm-3 col-md-3 col-log-3">
										<select class="form-control" name="status">
											<option value="">SELECT STATUS</option>
											<option value="2">Assign</option>
											<option value="3">Drop</option>
											<option value="5">Return</option>

										</select>
									</div>
									<div class="col-md-2 col-sm-2 col-lg-2">
										<input type="submit" name="submit" value="Filter" class="btn btn-primary">
									</div>
									</form>
									</div>
									<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Customer Name</th>
												<th>Item Code</th>
												<th>Item Name</th>
												<th>Address</th>
												<th>Phone No.</th>
												<th>Deliver Name</th>
												<th>Qty</th>
												<th>Price Per Item</th>
												<th>Route Reg Date</th>
												<th>Assign Date</th>
												<th>Status</th>
												<th>Remark</th>
												<th>Action</th>
											</tr>
										</thead>

										<tbody>
											@if(!isset($select_data))
											
											@foreach($select as $row)
											<?php $i++; ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td>{{$row->r_name}}</td>
												<td>{{$row->product_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->delivery_name}}</td>
												<td>{{$row->qty}}</td>
												<td>{{$row->amount}}</td>
												<td>{{$row->route_register_date}}</td>
												<td>
													<?php $date=$row->assign_date; 
													echo date("Y-m-d",strtotime($date));

													?>
												</td>
												<td>@if($row->status==2)
													<?php  echo "Assign"; ?>
													@elseif($row->status==3)
													<?php echo "Drop"; ?>
													@elseif($row->status==5)
													<?php echo "Return"; ?>
													@endif
												</td>
												<td>{{$row->remark}}</td>
												<td>@if($row->status==5)
													<a href="{{URL::to('re/scheldue/'.$row->rp_id.'/'.$row->r_pid)}}">
													<span class="lnr lnr-undo"></span>
													</a>
													@endif
												</td>
											</tr>
											@endforeach
											@else
											
											@foreach($select_data as $row)
											<?php $i++; ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td>{{$row->r_name}}</td>
												<td>{{$row->product_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->delivery_name}}</td>
												<td>{{$row->qty}}</td>
												<td>{{$row->amount}}</td>
												<td>{{$row->route_register_date}}</td>
												<td>
													<?php $date=$row->assign_date; 
													echo date("Y-m-d",strtotime($date));

													?>
												</td>
												<td>@if($row->status==2)
													<?php  echo "Assign"; ?>
													@elseif($row->status==3)
													<?php echo "Drop"; ?>
													@elseif($row->status==5)
													<?php echo "Return"; ?>
													@endif
												</td>
												<td>{{$row->remark}}</td>
												<td>@if($row->status==5)
													<a href="{{URL::to('re/scheldue/'.$row->rp_id.'/'.$row->r_pid)}}">
													<span class="lnr lnr-undo"></span>
													</a>
													@endif
												</td>
											</tr>
											@endforeach
											@endif
										</tbody>
									</table>
									</div>
									@if(!isset($select_data))
									{{ $select->appends(Request::except('/route/list'))->setPath('/route/list') }}
									@else
									{{ $select_data->appends(Request::except('/route/list'))->setPath('/route/list') }}
									@endif
								</div>
							</div>
							<!-- END BASIC TABLE -->
</div>

</div>

@endsection
