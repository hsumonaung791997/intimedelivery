@extends("layouts.admin")
@section('content')
            <div class="col-sm-12 col-lg-12 col-md-12">

<form action="{{URL::to('admin/account/ledger/update/')}}" method="POST">
  @csrf
                      <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Account Ledger  Edit</h3>
           
                </div>
                <div class="row">
                	
                </div>
           <div class="panel-body">

            <div class="row">
<div class="col-md-12">
	<div class="row">
      @foreach($result as $row)
<div class="col-md-6">
  <input type="hidden" name="route_plan_id" value="{{$row->route_plan_id}}">
  <input type="hidden" name="alid" value="{{$row->alid}}">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label for="form_name">Acc Transaction ID</label>
                      <input id="form_name" type="text" name="acc_t_id" class="form-control" >
                      <div class="help-block with-errors"></div>
                    </div>
                </div>
              	<div class="col-md-4">
              		<div class="form-group">
                <label for="form_name">Prouct ID</label>
                <input id="form_name" type="text" name="product_id" class="form-control" readonly value="{{$row->product_id}}" >
                <div class="help-block with-errors"></div>
              </div>
              	</div>
              	<div class="col-md-8">
              		<div class="form-group">
                <label for="form_name">Prouct Name</label>
                <input id="form_name" type="text" name="product_name" class="form-control" readonly  value="{{$row->product_name}}">
                <div class="help-block with-errors"></div>
              </div>
              	</div>
              </div>
              <div class="row">
              	<div class="col-md-4">
              		<div class="form-group">
                <label for="form_name">Quantity</label>
                <input id="form_name" type="text" name="qty" class="form-control"  readonly value="{{$row->quantity}}">
                <div class="help-block with-errors"></div>
              </div>
              	</div>
              	<div class="col-md-4">
              		<div class="form-group">
                <label for="form_name">Price Per Item</label>
                <input id="form_name" type="text" name="price_per_item" class="form-control" readonly value="{{$row->price_per_item}}">
                <div class="help-block with-errors"></div>
              </div>
              	</div>
              	<div class="col-md-4">
              		<div class="form-group">
                <label for="form_name">Total Amount</label>
                <input id="form_name" type="text" name="total_amount" class="form-control" readonly value="{{$row->price_per_item*$row->quantity}}">
                <div class="help-block with-errors"></div>
              </div>
              	</div>
              </div>
            </div>

            <div class="col-md-12">
            	<div class="row">
            		<div class="col-md-12">
            			<div class="row">
            				<div class="col-md-6">
            					<div class="form-group">
			                <label for="form_name">Postman Name</label>
			                <input id="form_name" type="text" name="postman_name" class="form-control" readonly value="{{$row->user_name}}">
			                <div class="help-block with-errors"></div>
			              </div>	
            				</div>
            				<div class="col-md-6">
            					<div class="form-group">
			                <label for="form_name">Assign Date</label>
			                <input id="form_name" type="text" name="assign_date" class="form-control" readonly value="{{$row->assign_date}}">
			                <div class="help-block with-errors"></div>
			              </div>	
            				</div>
            			</div>
            			<div class="row">
            				<div class="col-md-6">
            					<div class="form-group">
			                <label for="form_name">Register Date</label>
			                <input id="form_name" type="text" name="reg_date" class="form-control" readonly value="{{$row->registration_date}}">
			                <div class="help-block with-errors"></div>
			              </div>	
            				</div>
            				<div class="col-md-6">
            					<div class="form-group">
			                <label for="form_name">Target Date</label>
			                <input id="form_name" type="text" name="target_date" class="form-control" readonly value="{{$row->target_date}}">
			                <div class="help-block with-errors"></div>
			              </div>	
            				</div>
            			</div>
            			<div class="row">
            				<div class="col-md-6">
            					<div class="form-group">
			                <label for="form_name">Division</label>
			                <input id="form_name" type="text" name="s_name" class="form-control" readonly value="{{$row->division}}">
			                <div class="help-block with-errors"></div>
			              </div>	
            				</div>
            				<div class="col-md-6">
            					<div class="form-group">
			                <label for="form_name">Township</label>
			                <input id="form_name" type="text" name="t_name" class="form-control" readonly value="{{$row->township}}">
			                <div class="help-block with-errors"></div>
			              </div>	
            				</div>
            			</div>
            			<div class="col-md-12">
            			<div class="form-group">
			                <label for="form_name">Address</label>
			                <input id="form_name" type="text" name="address" class="form-control" readonly value="{{$row->address}}">
			                <div class="help-block with-errors"></div>
			              </div>
            		</div>
            		
            		</div>

            	</div>

            </div>
        </div>

<div class="col-md-6">
            <div class="col-md-12">
              <div class="row">
        

              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">Delivery Charges</label>
                <input id="form_name" type="text" name="delivery_charges" value="0" class="form-control" value="{{$row->delivery_charges}}" required="required">
                <div class="help-block with-errors"></div>
              </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">Over Tender Charges</label>
                <input id="form_name" type="text" name="over_tender_charges" class="form-control" value="{{$row->over_tender_charges}}"   required="required">
                <div class="help-block with-errors"></div>
              </div>
                </div>
              </div>
                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">Notification Date</label>
                <input id="form_name" type="date" name="notification_date" class="form-control" value="<?php echo  date('Y-m-d'); ?>"   required="required">
                <div class="help-block with-errors"></div>
              </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">Extra Charges</label>
                <input id="form_name" type="text" name="extra_charges" class="form-control" value="{{$row->extra_charges}}"   required="required">
                <div class="help-block with-errors"></div>
              </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">Payment Status</label>
                <select class="form-control" name="payment_status" required>
                 <option <?php if($row->paid_unpaid==0){echo "selected";}; ?> value="0">Unpaid</option>
                 <option <?php if($row->paid_unpaid==1){echo "selected";}; ?> value="1">Paid</option>
                </select>
                <div class="help-block with-errors"></div>
              </div>
                </div>
                 <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">Transaction Date</label>
                <input type="date" name="transaction_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
                <div class="help-block with-errors"></div>
              </div>
                </div>
              </div>
              <?php $tot=$row->extra_charges+$row->over_tender_charges+$row->delivery_charges;
               $p_price=$row->quantity*$row->price_per_item;
               $net_payment=$p_price+$tot;
             ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">Total Charges : <?php echo $net_payment; ?> </label>
                <div class="help-block with-errors"></div>
              </div>
                </div>
              </div>
            </div>

            
        </div>

</div>
<div class="col-md-12">
  <input type="submit" name="submit" class="btn btn-primary">
</div>
          </div>
      </div>
                  
                </div>
                  </div>
   </form>
            </div>

           @endforeach


@endsection