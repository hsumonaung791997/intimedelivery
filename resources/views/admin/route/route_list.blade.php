@extends("layouts.admin")
@section('content')
<?php $i=1; ?>

<div class="row">

<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Verify Route List</h3>
								</div>
								<form action="{{URL::to('admin/route/list/table/search')}}" method="get">
									@csrf
								<div class="panel-body">
									<div class="col-md-12 col-lg-12 col-sm-12">
					                    <div class="col-md-3 col-lg-3 col-sm-3">
					                    <input type="text" class="form-control" name="search" placeholder="Vendor Name">
					                  </div>
					                  <div class="col-md-3 col-lg-3 col-sm-3">
					                    <input type="date" class="form-control" name="date">
					                  </div>
					                   <div class="col-md-3 col-lg-3 col-sm-3">
					                    	<?php $state=DB::select("SELECT * FROM state ORDER BY id DESC"); ?>
					                    <select class="form-control" name="state">
					                    	<option value="">SELECT STATE</option>
					                      @foreach($state as $sta)
					                      <option value="{{$sta->id}}">{{$sta->name}}</option>
					                      @endforeach
					                    </select>
					                  </div>
					                  <div class="col-md-2 col-sm-2 col-lg-2">
					                    <input type="submit" name="submit" value="Filter" class="btn btn-primary">
					                  </div>
					                  </div>
					                  <div class="col-md-12 col-lg-12 col-sm-12" style="margin-top: 1%;">
					                   
                  
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
											</tr>
										</thead>
										<tbody>
									@if(isset($data))
										
												@foreach($data as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->address}},{{$row->s_name}},{{$row->t_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->p_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->qty}}</td>
												<td>{{$row->amount}}</td>
												<td><?php echo date("d-m-Y", strtotime($row->reg_date)); ?></td>
												<td>{{$row->target_date}}:{{$row->target_time}}</td>
												<td>{{$row->product_vendor_name}}</td>
											</tr>
											@endforeach

									@endif
									@if(isset($select_date))
											@foreach($select_date as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->address}},{{$row->s_name}},{{$row->t_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->p_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->qty}}</td>
												<td>{{$row->amount}}</td>
												<td><?php echo date("d-m-Y", strtotime($row->reg_date)); ?></td>
												<td>{{$row->target_date}}:{{$row->target_time}}</td>
												<td>{{$row->product_vendor_name}}</td>
												
											</tr>
											@endforeach
									@endif
										</tbody>
									</table>
								</div>
							</form>
							</div>
		</div>
</div>
@endsection
