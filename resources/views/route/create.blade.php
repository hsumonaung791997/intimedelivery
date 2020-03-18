@extends("layouts.tables")
@section('content')
  <link rel="stylesheet" href="{{URL::to('/wickedpicker.min.css')}}">
<script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<form action="{{URL::to('/route/plan/store')}}" method="post" >
  @csrf
            <div class="col-sm-12 col-lg-12 col-md-12">
              <div class="row">

                  <div class="col-md-4 col-lg-4 col-sm-4">
                      <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Route Plan </h3>
           
                </div>
                <div class="panel-body">
                     <div class="row">

            <div class="col-md-12 mt-4">
               <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Phone</label>
                <input id="form_lastname" type="text" name="phone" class="form-control" placeholder="eg 09123456789" required="required" data-error="phone number is required.">
                <div class="help-block with-errors"></div>
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Receive Name</label>
                <input id="form_lastname" type="text" name="r_name" class="form-control" placeholder="Eg Mg Mg, Ko Ko" required="required" data-error="Receiver Name is required.">
                <div class="help-block with-errors"></div>
              </div>
            </div>
              <div class="form-group" style="margin-top: 4%;">
                <label for="form_name">Address</label>
                <input id="form_name" type="text" name="address" class="form-control" placeholder="Ex(N0.72,Road,Street)" required="required">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <div class="col-md-6">
              <div class="form-group">
                <label for="form_name">State</label>
                <select class="form-control" name="state" id="state">
                                    <option>SELECT STATE</option>
                  @foreach($state as $row)

                  <option value="{{$row->id}}">{{$row->name}}</option>
                  @endforeach
                </select>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Township</label>
                <select class="form-control" name="township" id="township">
                  <option>SELECT TOWNSHIP</option>
                </select>
                <div class="help-block with-errors"></div>
              </div>
            </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                <label for="form_name">Quantity</label>
                <input id="form_name" type="number" name="quantity" class="form-control" placeholder="Product Quantity" required="required">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Amount (MMK)</label>
                <input id="form_lastname" type="number" name="amount" class="form-control" placeholder="Price Per Item" required="required" data-error="Lastname is required.">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="form_lastname">F.O.C Amount / Discount</label>
                <input id="form_lastname" type="number" name="foc" class="form-control" placeholder="F.O.C Amount" required="required" data-error="Lastname is required.">
                <div class="help-block with-errors"></div>
              </div>
            </div>

             <div class="col-md-6 mt-2">
              <div class="form-group">
                <label for="form_name">Target Date</label>
                <input id="form_name" type="date" name="target_date" class="form-control" placeholder="Product Quantity" required="required">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <div class="form-group">
                <label for="form_lastname">Target Time</label>
                <input class="form-control timepicker-24-hr" name="target_time" id="timepicker-24-hr" required="required">
                <div class="help-block with-errors"></div>
              </div>
            </div>
           <div class="col-md-12">
              <div class="form-group">
                <label for="form_lastname">Remark</label>
                <input class="form-control" name="remark"  required="required" value="-">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            </div>

          </div>
          <div style="margin-top: 4%;">
                  <input type="submit" class="btn btn-primary btn-bottom center-block">
                  </div>
                </div>
              </div>
                  </div>
                  <div class="col-md-8 col-lg-8 col-sm-8">
                       <!-- TIMELINE -->
              <div class="panel panel-scrolling">
                <div class="panel-heading">
                  <h3 class="panel-title">Select Product</h3>
                </div>

                <div class="panel-body">
                  <div class="col-sm-3 col-lg-3 col-md-3">
              <input id="myInput" type="text" placeholder="Search.." class="form-control">
                    
                  </div>
                  @if($errors->any())
                <span class="label label-success" style="font-size: 25px;">{{$errors->first()}}</span>
                @endif
                  <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Product ID</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Product Size</th>
                      <th scope="col">Product Type</th>
                      <th scope="col">Product Vendor Name</th>
                    </tr>
                  </thead>
                  <tbody  id="myTable">
                    @foreach($product as $row)
                     <tr>
                      <th scope="row">
                       <label class="control-inline fancy-checkbox">
                        <input type="checkbox" value="{{$row->product_id}}" name="product_id" class="test"><span></span>
                      </label>
                      </th>
                      <td>{{$row->p_id}}</td>
                      <td>{{$row->product_name}}</td>
                      <td>{{$row->product_size}}</td>
                      <td>{{$row->product_type}}</td>
                      <td>{{$row->product_vendor_name}}</td>
                    </tr>
                     @endforeach
                  </tbody>
                </table>
    
                </div>
            </form>
                
              </div>
                  </div>
                  <!--  -->
                   <div class="col-md-8 col-lg-8 col-sm-8">
                       <!-- TIMELINE -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Import Route</h3>
                </div>
<form method="post" enctype="multipart/form-data" action="{{ url('/import/route') }}">
                    @csrf
                <div class="panel-body">
                  <div class="col-sm-12 col-lg-12 col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                   
                    <div class="form-group">
                      <input id="form_lastname" type="file" name="file" class="form-control" >
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                   <div class="col-md-6">
                    <div class="form-group">
                      <input  type="submit" class="btn btn-primary">
                    </div>
                  </div>
                  </form>
                  
                    </div>
                    
                  </div>
                
    
                </div>
                
              </div>
                  </div>
                  <!--  -->
              </div>
            </div>
           <div class="col-md-12">
              <!-- BASIC TABLE -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Route List (Pending And Approve List)</h3>
                </div>
                <div class="panel-body">

                  <table class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Address</th>
                        <th>Phone No.</th>
                        <th>Reg: Date</th>
                        <th>Target Date</th>
                        <th>Qty</th>
                        <th>Price Per Item</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Delete</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                      @foreach($select as $sel)
                      <tr>
                        <td><?php  echo $i++; ?></td>
                        <td>{{$sel->r_name}}</td>
                        <td>{{$sel->p_id}}</td>
                        <td>{{$sel->product_name}}</td>
                        <td>{{$sel->address}},{{$sel->s_name}},{{$sel->t_name}}</td>
                        <td>{{$sel->phone}}</td>
                        <td>{{$sel->reg_date}}</td>
                        <td>
                         <?php $date=$sel->target_date;
                                $dates=date("Y-m-d",strtotime($date));
                                echo $date_time=$dates.' '.$sel->target_time;
                          ?>
                        </td>
                        <td>{{$sel->quantity}}</td>
                        <td>{{$sel->amount}}</td>
                        <td>{{$sel->amount*$sel->quantity}}</td>
                        <td>@if($sel->status==1)
                          <?php echo "Confirmed"; ?>
                          @elseif($sel->status==0)
                          <?php echo "Pending"; ?>
                          @endif
                        </td>
                        <td><a class="btn btn-danger btn-sm" href="{{URL::to('route/delete/'.$sel->id)}}">Delete</a></td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- END BASIC TABLE -->
</div>

<script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{URL::to('/wickedpicker.min.js')}}"></script>

<script>
  var twelveHour = $('.timepicker-12-hr').wickedpicker();
            $('.time').text('//JS Console: ' + twelveHour.wickedpicker('time'));
            $('.timepicker-24-hr').wickedpicker({twentyFour: true});
            $('.timepicker-12-hr-clearable').wickedpicker({clearable: true});
</script>
<script type="text/javascript">
  $('input.test').on('change', function() {
    $('input.test').not(this).prop('checked', false);  
});
</script>
<script type="text/javascript">

    $(function () {
          $("#state").on('click',function () {

            $state=$('#state').val();

            $.ajax({

            type : 'get',

            url : '{{URL::to('/order/entry/state')}}',

            data:{'state':$state},

            success:function(data){

            $('#township').html(data);
            }

            });
        });

    });
</script>

@endsection