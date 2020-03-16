@extends("layouts.admin")
@section('content')
            <div class="col-sm-12 col-lg-12 col-md-12">

<form action="{{URL::to('admin/highway/update/')}}" method="POST">
  @csrf
                      <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Route Plan  Edit</h3>
           
                </div>
                <div class="row">
                	
                </div>
           <div class="panel-body">

            <div class="row">
<div class="col-md-12">
	<div class="row">
      @foreach($result as $row)
      <input type="hidden" name="plan_id" value="{{$row->id}}">
<div class="col-md-6">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                <label for="form_name">Customer Name</label>
                <input id="form_name" type="text" name="r_name" class="form-control" readonly value="{{$row->r_name}}" >
                <div class="help-block with-errors"></div>
              </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                <label for="form_name">Phone</label>
                <input id="form_name" type="text" name="phone" class="form-control" readonly value="{{$row->phone}}" >
                <div class="help-block with-errors"></div>
              </div>
                </div>
              	<div class="col-md-4">
              		<div class="form-group">
                <label for="form_name">Prouct ID</label>
                <input id="form_name" type="text" name="product_id" class="form-control" readonly value="{{$row->p_id}}" >
                <div class="help-block with-errors"></div>
              </div>
              	</div>
              	<div class="col-md-8">
              		<div class="form-group">
                <label for="form_name">Prouct Name</label>
                <input id="form_name" type="text" name="product_name" class="form-control" readonly value="{{$row->product_name}}" >
                <div class="help-block with-errors"></div>
              </div>
              	</div>
              </div>
              <div class="row">
              	<div class="col-md-4">
              		<div class="form-group">
                <label for="form_name">Quantity</label>
                <input id="form_name" type="text" name="qty" class="form-control" value="{{$row->qty}}" readonly>
                <div class="help-block with-errors"></div>
              </div>
              	</div>
              	<div class="col-md-4">
              		<div class="form-group">
                <label for="form_name">Price Per Item</label>
                <input id="form_name" type="text" name="price_per_item" class="form-control" readonly value="{{$row->amount}}">
                <div class="help-block with-errors"></div>
              </div>
              	</div>
              	<div class="col-md-4">
              		<div class="form-group">
                <label for="form_name">Total Amount</label>
                <input id="form_name" type="text" name="total_amount" class="form-control" readonly value="{{$row->amount*$row->qty}}">
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
			                <label for="form_name">Register Date</label>
			                <input id="form_name" type="text" name="reg_date" class="form-control" readonly value="{{$row->reg_date}}">
			                <div class="help-block with-errors"></div>
			              </div>	
            				</div>
            				<div class="col-md-6">
            					<div class="form-group">
			                <label for="form_name">Target Date</label>
                      <?php $target_date=$row->target_date; ?>
			                <input id="form_name" type="text" name="target_date" class="form-control" readonly value="<?php echo date("m/d/Y",strtotime($target_date));?>">
			                <div class="help-block with-errors"></div>
			              </div>	
            				</div>
            			</div>
            			<div class="row">
            				<div class="col-md-6">
            					<div class="form-group">
			                <label for="form_name">Division</label>
			                <input id="form_name" type="text" name="s_name" class="form-control" readonly value="{{$row->s_name}}">
			                <div class="help-block with-errors"></div>
			              </div>	
            				</div>
            				<div class="col-md-6">
            					<div class="form-group">
			                <label for="form_name">Township</label>
			                <input id="form_name" type="text" name="t_name" class="form-control" readonly value="{{$row->t_name}}">
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
            @endforeach
           @foreach($result as $row)
<div class="col-md-6">
            <div class="col-md-12">
              <div class="row">
              	<div class="col-md-12">
            			<div class="form-group">
			                <label for="form_name">Remark</label>
			                <textarea class="form-control" name="remark">- {{$row->remark}}</textarea> 	
			                <div class="help-block with-errors"></div>
			              </div>
            		</div>

              </div>
              <div class="row">
              	<div class="col-md-6">
              		<div class="form-group">
                <label for="form_name">Delivery Charges</label>
                <input id="form_name" type="text" name="delivery_charges" value="0" class="form-control" required="required">
                <div class="help-block with-errors"></div>
              </div>
              	</div>
              	<div class="col-md-6">
              		<div class="form-group">
                <label for="form_name">Over Tender Charges</label>
                <input id="form_name" type="text" name="over_tender_charges" class="form-control" value="0"   required="required">
                <div class="help-block with-errors"></div>
              </div>
              	</div>
              </div>
                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">F.O.C Amount / Discount</label>
                <input id="form_name" type="text" name="notification_date" class="form-control" value="{{$row->foc}}"   required="required">
                <div class="help-block with-errors"></div>
              </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">Extra Charges</label>
                <input id="form_name" type="text" name="extra_charges" class="form-control" value="0"   required="required">
                <div class="help-block with-errors"></div>
              </div>
                </div>
                 <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">Transport Charges</label>
                <input id="form_name" type="text" name="transport_charges" class="form-control" value="0"   required="required">
                <div class="help-block with-errors"></div>
              </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">Notification Date</label>
                <input id="form_name" type="date" name="notification_date" class="form-control" value="<?php echo  date('Y-m-d', strtotime('-1 day', strtotime($target_date))); ?>"   required="required">
                <div class="help-block with-errors"></div>
              </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                <label for="form_name">Payment Status</label>
                <select class="form-control" name="payment_status" required>
                    <option  value="0">Unpaid</option>
                  <option   value="1">Paid</option>
                </select>
                <div class="help-block with-errors"></div>
              </div>
                </div>
              </div>
            </div>

            
        </div>
            @endforeach

</div>
<div class="col-md-12">
  <input type="submit" name="submit" class="btn btn-primary" value="Update">

</div>
          </div>
      </div>
                  
                </div>
                  </div>
   </form>
            </div>

           


@endsection