@extends('layouts.admin')
@section('content')
<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel">
			<div class="panel-body">
				<h4 class="panel-heading">Stock Receive</h4>
					                    
		<form action="{{URL::to('warehouse/stock/received')}}" method="post">
                  @csrf
									<div class="form-group">
					      
					 	 <div class="col-lg-12">
					 	 	<input type="text" name="route_plan_id" autofocus="">
					      	<input type="submit" name="submit" class="btn btn-primary btn-sm" style="margin-top: -0.5%;">
					      </div>
					       <div class="col-lg-6 " style="margin-top: 1%;">
					      @if (\Session::has('error'))
					    <div class="alert alert-danger">
					        <ul>
					            <li>{!! \Session::get('error') !!}</li>
					        </ul>
					    </div>
					@endif
				</div>
					      </form>
					      
					       <div class="col-lg-12 table-responsive">
					      	  <table class="table"  style="font-size: 13px;">
					      	  	<thead>
		      	  					<th>No</th>
									<th>Product ID</th>
									<th>Product Name</th>
									<th>Product Type</th>
									<th>Product Size</th>
									<th>Vendor Name</th>
									<th>Quantity</th>
									<th>Price Per Item</th>
									<th>Date</th>
									<th>Action</th>
					      	  	</thead>
					      	  	<tbody>
					      	  		<?php $i=1; ?>
					      	  		@foreach($result as $row)
					      	  		<tr>
					      	  			<td>{{$i++}}</td>
					      	  			<td>{{$row->p_id}}</td>
					      	  			<td>{{$row->product_name}}</td>
					      	  			<td>{{$row->product_type}}</td>
					      	  			<td>{{$row->product_size}}</td>
					      	  			<td>{{$row->product_vendor_name}}</td>
					      	  			<td>{{$row->quantity}}</td>
					      	  			<td>{{$row->amount}}</td>
					      	  			<td><?php $date=$row->created_at;
					      	  				echo date("Y-m-d H:i:s",strtotime($date));
					      	  			 ?></td>
					      	  			 <td><a href="{{URL::to('warehouse/stock/received/delete/'.$row->route_plan_id)}}" class="btn btn-danger btn-sm">Cancel</a></td>
					      	  		</tr>
					      	  		@endforeach
					      	  		
					      	  	</tbody>
					      	  </table>
					      	  {{ $result->appends(Request::except('/warehouse/stock/receive'))->setPath('/warehouse/stock/receive') }}
					      </div>
					    </div>
		
				
			</div>
		</div>
		@endsection