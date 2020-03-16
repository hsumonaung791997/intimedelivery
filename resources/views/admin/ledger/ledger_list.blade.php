@extends("layouts.admin")
@section('content')

<div class="row">

<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Ledger List</h3>
								</div>
								<div class="panel-body">
                  <div class="row">
                    <form action="{{URL::to('admin/ledger/list/search')}}" method="get">
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
                                  if(isset($_GET['payment_status'])){
                                    $payment_status=$_GET['payment_status'];
                                  }else{
                                    $payment_status='444';
                                  }
                                  if(isset($_GET['route_status'])){
                                    $route_status=$_GET['route_status'];
                                  }else{
                                    $route_status='444';
                                  }

                                   ?>
                  <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="col-md-3 col-lg-3 col-sm-3">
                    <input type="text" class="form-control" name="search" placeholder="Search Text" value="{{$name}}">
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-3">
                   <input placeholder="Choose Registration Date" name="date" class="textbox-n form-control" value="{{$date}}" type="text" onfocus="(this.type='date')" value=""  id="date"> 
                  </div>
              
                  </div>
                  <div class="col-md-12 col-lg-12 col-sm-12" style="margin-top: 1%;">
                    <div class="col-md-3 col-lg-3 col-sm-3">
                    <select class="form-control" name="payment_status">
                      <option value="">Select Paid or UnPaid</option>
                      @if($payment_status==0)
                      <option value="0" selected>UnPaid</option>
                      @elseif($payment_status==1)
                      <option value="1" selected>Paid</option>
                      @endif
                      <option value="1">Paid</option>
                      <option value="0">UnPaid</option>

                    </select>
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-3">
                    <select class="form-control" name="route_status">
                      <option value="">SELECT Route Status</option>
                      @if($route_status==2)
                      <option value="2" selected>Assign</option>
                      @elseif($route_status==3)
                      <option value="3" selected>Drop</option>
                      @elseif($route_status==5)
                      <option value="5" selected>Return</option>
                      @endif
                      <option value="2">Assign</option>
                      <option value="3">Drop</option>
                      <option value="5">Return</option>

                    </select>
                  </div>
                  <div class="col-md-2 col-sm-2 col-lg-2">
                    <input type="submit" name="filter" value="Filter" class="btn btn-primary">
                    <input type="submit" name="print" value="Print" class="btn btn-success">
                  </div>
                  </div>
                  </form>
                  </div>
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Acc - T - ID</th>
												<th>Address</th>
                        <th>Phone</th>
												<th>Price</th>
												<th>Qty</th>
												<th>Total Amount</th>
												<th>Route Status</th>
												<th>Payment Status</th>
												<th>Registration Date</th>
                        <th>Reason</th>
                        <th>Vendor Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
                      @if(isset($result_data))
											<?php $i=1; ?>
											@foreach($result_data as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->acc_transction_id}}</td>
												<td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
                        <td>{{$row->phone}}</td>
												<td>{{$row->price_per_item}}</td>
												<td>{{$row->quantity}}</td>
												<td>{{$row->price_per_item*$row->quantity}}</td>
												<td>
													@if($row->status==2)
													<?php echo "Assign"; ?>
													@elseif($row->status==3)
													<?php echo "Drop"; ?>
													@elseif($row->status==5)
													<?php echo "Return"; ?>
													@endif
												</td>
												<td>
													@if($row->paid_unpaid==0)
														<?php echo "Unpaid"; ?>
													@else
														<?php echo "Paid"; ?>
													@endif
												</td>
												<td><?php $date=$row->registration_date; 
												echo date("d/m/Y", strtotime($date));
												?></td>
                        <td>{{$row->remark}}</td>
                        <td>{{$row->product_vendor_name}}</td>
												<td>
													<div class="dropdown">
  														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    														Modify
  														</button>
  														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    														<div class="text-center"><a class="dropdown-item" data-toggle="modal" data-target="#exampleModalLong<?php echo $row->route_plan_id; ?>" href="#">Preview</a></div>
    														<div class="text-center"><a class="dropdown-item" href="{{URL::to('admin/account/ledger/edit/'.$row->alid.'/'.$row->route_plan_id)}}">Edit</a></div>
    														<div class="text-center"><a class="dropdown-item" href="#">Delete</a></div>
   														</div>
													</div>   
                      
												</td>
											</tr>
											@endforeach
                      @else
                      <?php $i=1; ?>
                      @foreach($result as $row)
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td>{{$row->acc_transction_id}}</td>
                        <td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
                        <td>{{$row->phone}}</td>
                        <td>{{$row->price_per_item}}</td>
                        <td>{{$row->quantity}}</td>
                        <td>{{$row->price_per_item*$row->quantity}}</td>
                        <td>
                          @if($row->status==2)
                          <?php echo "Assign"; ?>
                          @elseif($row->status==3)
                          <?php echo "Drop"; ?>
                          @elseif($row->status==5)
                          <?php echo "Return"; ?>
                          @endif
                        </td>
                        <td>
                          @if($row->paid_unpaid==0)
                            <?php echo "Unpaid"; ?>
                          @else
                            <?php echo "Paid"; ?>
                          @endif
                        </td>
                        <td><?php $date=$row->registration_date; 
                        echo date("d/m/Y", strtotime($date));
                        ?></td>
                        <td>{{$row->remark}}</td>
                        <td>{{$row->product_vendor_name}}</td>
                        <td>
                          <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Modify
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="text-center"><a class="dropdown-item" data-toggle="modal" data-target="#exampleModalLong<?php echo $row->route_plan_id; ?>" href="#">Preview</a></div>
                                <div class="text-center"><a class="dropdown-item" href="{{URL::to('admin/account/ledger/edit/'.$row->alid.'/'.$row->route_plan_id)}}">Edit</a></div>
                                <div class="text-center"><a class="dropdown-item" href="#">Delete</a></div>
                              </div>
                          </div>   
                      
                        </td>
                      </tr>
                      @endforeach
                      @endif
										</tbody>
									</table>
                  @if(isset($result_data))
                  {{ $result_data->appends(Request::except('/admin/ledger/list/search'))->setPath('/admin/ledger/list/search') }}
                  @else
                  {{ $result->appends(Request::except('/admin/ledger/list'))->setPath('/admin/ledger/list') }}
                  @endif
								</div>
							</div>
							<!-- END BASIC TABLE -->
</div>

</div>

<!-- Modal -->


<!-- Modal -->
@if(isset($result))
@foreach($result as $row)
<div class="modal fade" id="exampleModalLong<?php echo $row->route_plan_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table">
       	<tr>
       		<td>Acc T ID</td>
       		<td>{{$row->acc_transction_id}}</td>
       	</tr>
       	<tr>
       		<td>Product ID</td>
       		<td>{{$row->product_id}}</td>
       	</tr>
       		<tr>
       		<td>Product Name</td>
       		<td>{{$row->product_name}}</td>
       	</tr>
       		<tr>
       		<td>Quantity</td>
       		<td>{{$row->quantity}}</td>
       	</tr>
       	<tr>
       		<td>Price Per Item</td>
       		<td>{{$row->price_per_item}}</td>
       	</tr>
       		<tr>
       		<td>Total Amount</td>
       		<td>{{$row->price_per_item*$row->quantity}}</td>
       	</tr>
       	<tr>
       		<td>Address</td>
                        <td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
       	</tr>
       	<tr>
       		<td>Delivery Name</td>
       		<td>{{$row->user_name}}</td>
       	</tr>
       	
       	<tr>
       		<td>Route Status</td>
       		<td>@if($row->status==2)
				<?php echo "Assign"; ?>
				@elseif($row->status==3)
				<?php echo "Drop"; ?>
				@elseif($row->status==5)
				<?php echo "Return"; ?>
				@endif</td>
       	</tr>
       
       
       	<tr>
       		<td>Extra Charge</td>
       		<td>{{$row->extra_charges}}</td>
       	</tr>
       	<tr>
       		<td>Over Charges</td>
       		<td>{{$row->over_tender_charges}}</td>
       	</tr>
       		<tr>
       		<td>Delivery Charges</td>
       		<td>{{$row->delivery_charges}}</td>
       	</tr>
       	<tr>
       		<td>Payment Status</td>
       		<td>@if($row->paid_unpaid==0)
				<?php echo "Unpaid"; ?>
			@else
				<?php echo "Paid"; ?>
			@endif</td>
       	</tr>
       	<tr>
       		<td>Registration Date</td>
       		<td>{{$row->registration_date}}</td>
       	</tr>
       	<tr>
       		<td>Target Date</td>
       		<td>{{$row->target_date}}</td>
       	</tr>
       	<tfoot>
       		<tr>
       			<td><h4>Total Charges</h4></td>
       			<?php $tot=$row->extra_charges+$row->over_tender_charges+$row->delivery_charges;
       				 $p_price=$row->quantity*$row->price_per_item;
       				 $net_payment=$p_price+$tot;
       			 ?>
       			<td><h4>{{$net_payment}}</h4></td>
       		</tr>
       	</tfoot>
       </table>
      </div>
      <div class="modal-footer">
      	<a  class="btn btn-link" href="{{URL::to('admin/account/ledger/edit/'.$row->alid.'/'.$row->route_plan_id)}}">Edit</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@else
@foreach($result_data as $row)
<div class="modal fade" id="exampleModalLong<?php echo $row->route_plan_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table">
        <tr>
          <td>Acc T ID</td>
          <td>{{$row->acc_transction_id}}</td>
        </tr>
        <tr>
          <td>Product ID</td>
          <td>{{$row->product_id}}</td>
        </tr>
          <tr>
          <td>Product Name</td>
          <td>{{$row->product_name}}</td>
        </tr>
          <tr>
          <td>Quantity</td>
          <td>{{$row->quantity}}</td>
        </tr>
        <tr>
          <td>Price Per Item</td>
          <td>{{$row->price_per_item}}</td>
        </tr>
          <tr>
          <td>Total Amount</td>
          <td>{{$row->price_per_item*$row->quantity}}</td>
        </tr>
        <tr>
          <td>Address</td>
                        <td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
        </tr>
        <tr>
          <td>Delivery Name</td>
          <td>{{$row->user_name}}</td>
        </tr>
        
        <tr>
          <td>Route Status</td>
          <td>@if($row->status==2)
        <?php echo "Assign"; ?>
        @elseif($row->status==3)
        <?php echo "Drop"; ?>
        @elseif($row->status==5)
        <?php echo "Return"; ?>
        @endif</td>
        </tr>
       
       
        <tr>
          <td>Extra Charge</td>
          <td>{{$row->extra_charges}}</td>
        </tr>
        <tr>
          <td>Over Charges</td>
          <td>{{$row->over_tender_charges}}</td>
        </tr>
          <tr>
          <td>Delivery Charges</td>
          <td>{{$row->delivery_charges}}</td>
        </tr>
        <tr>
          <td>Payment Status</td>
          <td>@if($row->paid_unpaid==0)
        <?php echo "Unpaid"; ?>
      @else
        <?php echo "Paid"; ?>
      @endif</td>
        </tr>
        <tr>
          <td>Registration Date</td>
          <td>{{$row->registration_date}}</td>
        </tr>
        <tr>
          <td>Target Date</td>
          <td>{{$row->target_date}}</td>
        </tr>
        <tfoot>
          <tr>
            <td><h4>Total Charges</h4></td>
            <?php $tot=$row->extra_charges+$row->over_tender_charges+$row->delivery_charges;
               $p_price=$row->quantity*$row->price_per_item;
               $net_payment=$p_price+$tot;
             ?>
            <td><h4>{{$net_payment}}</h4></td>
          </tr>
        </tfoot>
       </table>
      </div>
      <div class="modal-footer">
        <a  class="btn btn-link" href="{{URL::to('admin/account/ledger/edit/'.$row->alid.'/'.$row->route_plan_id)}}">Edit</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif
@endsection
