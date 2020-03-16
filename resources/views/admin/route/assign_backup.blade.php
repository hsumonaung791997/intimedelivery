@extends("layouts.admin")
@section('content')
  <link rel="stylesheet" href="{{URL::to('bootstrap-select.css')}}">
<div class="row">

<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">

									<h3 class="panel-title pull-left">Assign Postman</h3>

									<a href="{{URL::to('admin/route/assign')}}" class="pull-right"><h4><span class="lnr lnr-sync"></span></h4></a>
									@if ($errors->any())
									<a href="#" class="pull-right" style="margin-right: 50px;color: red;"><h4>You must select at lease one parcel</h4></a>
									@endif
								</div>
								<div class="panel-body">
					<form role="form" action="{{asset('admin/assign/route')}}" method="get">
						@csrf
					    <div class="form-group">
				

					      <div class="col-lg-3">
					      		      <label for="basic" class="control-label">Select Postman</label>
					        <select id="basic" class="selectpicker show-tick form-control" name="postman" data-live-search="true">
					        	@foreach($postman as $row)
					          <option value="{{$row->id}}" > {{$row->delivery_name}} </option>
					        	@endforeach
					        </select>
					      </div>
					    </div>
					    <div class="form-group">
				

					      <div class="col-lg-2">
					      		      <label for="basic" class="control-label">Select State</label>
					        <select  class="form-control state" name="state" id="state" required="required">
					        	
					        	@if(isset($_GET['state']))
					        		<?php $stateid=$_GET['state'];
					        			$state_list=DB::select("SELECT * FROM state where id='$stateid'");
					        		 ?>
					        		 @foreach($state_list as $state_rows)
					        		 <option value="{{$state_rows->id}}" selected>{{$state_rows->name}}</option>
					        		 @endforeach

					        		 @foreach($state as $state_row)
					        		 <option value="{{$state_row->id}}">{{$state_row->name}}</option>
					        		 @endforeach
					        	@else
					        		@foreach($state as $state_row)
					        		 <option value="{{$state_row->id}}">{{$state_row->name}}</option>
					        		 @endforeach
					        	@endif
					        </select>
					      </div>
					    </div>
					     <div class="form-group">
				

					      <div class="col-lg-2">
					      		      <label for="basic" class="control-label">Select Township</label>
					        <select class="form-control" name="township" id="township" required="required">
					        	@if(isset($_GET['township']))
					        	<?php $townshipid=$_GET['township'];
					        			$township_list=DB::select("SELECT * FROM township where id='$townshipid'");
					        			$state_township=DB::select("SELECT * FROM township where state_id='$stateid'");
					        		 ?>
					        		 @foreach($township_list as $towship_row)
					        		 <option value="{{$towship_row->id}}" selected>{{$towship_row->name}}</option>
					        		 @endforeach

					        		  @foreach($state_township as $state_township_row)
					        		 <option value="{{$state_township_row->id}}">{{$state_township_row->name}}</option>
					        		 @endforeach
					        	@else
					        	 <?php $township_first=DB::select("SELECT * FROM township where state_id=1"); ?>
					        	 @foreach($township_first as $township_firsts)
					        	 <option value="{{$township_firsts->id}}">{{$township_firsts->name}}</option>
					        	 @endforeach
					        	@endif
					        	
					        </select>
					      </div>
					    </div>
					      <div class="form-group">
				

					      <div class="col-lg-2">
					      		      <label for="basic" class="control-label">Deliver Date</label>
					        <input type="date" name="deliver_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
					      </div>
					    </div>
					    <div class="form-group">
				

					      
					      
					      <div class="col-lg-1 mt-4">
					      		    
					        <input type="submit" name="search" class="btn btn-success" style="margin-top: 22px;" value="Search ">
					      </div>
					      <div class="col-lg-2 mt-4">
					      		    
					        <input type="submit" name="assign_route" class="btn btn-primary" style="margin-top: 22px;" value="Assign Route">
					      </div>
					    </div>
								</div>

								<table class="table">
										<thead>
											<tr>
												<th> <label class="control-inline fancy-checkbox"> <input type="checkbox" class="check" id="checkAll" value="check all" /><span></span>
						                      </label></th>
												<th>No</th>
												<th>Division/State</th>
												<th>Township</th>
												<th>Address</th>
												<th>Product name</th>
												<th>Order Date</th>
												<th>Target Date</th>
												<th>Qty</th>
												<th>Total Amount</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; ?>
											@foreach($data as $row)
											<tr>
												 <th scope="row">
						                       <label class="control-inline fancy-checkbox">
						 <input type="checkbox" name="plan_id[]" value="{{$row->route_plan_id}}" class="cb-element"><span></span>
						                      </label>
						                      </th>
												<td><?php echo $i++; ?></td>
												<td>{{$row->s_name}}</td>
												<td>{{$row->t_name}}</td>
												<td>{{$row->address}}</td>
												<td>{{$row->product_name}}</td>
												<td><?php echo date('d-m-Y', strtotime($row->reg_date)); ?></td>
												<td>{{$row->target_date}}</td>
												<td>{{$row->qty}}</td>
												<td>{{$row->amount}}</td>
												<td>
													<div class="dropdown">
  														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    														Modify
  														</button>
  														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  															<div class="text-center"><a class="dropdown-item" href="#">Preview</a></div>
  															<div class="text-center">
  													
   														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalLong">
													  Show QR
													</a> 
  																
  															</div>
  															
    														<div class="text-center"><a class="dropdown-item" href="#">Edit</a></div>
    														<div class="text-center"><a class="dropdown-item" href="#">Delete</a></div>
   														</div>
													</div>   
                      
												</td>
											</tr>
											 @endforeach
												
										</tbody>
									</table>
							</div>
							<!-- END BASIC TABLE -->
					</div>
			</form>

</div>
<script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{URL::to('bootstrap-select.js')}}"></script>
<script>
function createOptions(number) {
  var options = [], _options;

  for (var i = 0; i < number; i++) {
    var option = '<option value="' + i + '">Option ' + i + '</option>';
    options.push(option);
  }

  _options = options.join('');
  
  $('#number')[0].innerHTML = _options;
  $('#number-multiple')[0].innerHTML = _options;

  $('#number2')[0].innerHTML = _options;
  $('#number2-multiple')[0].innerHTML = _options;
}

var mySelect = $('#first-disabled2');

createOptions(4000);

$('#special').on('click', function () {
  mySelect.find('option:selected').prop('disabled', true);
  mySelect.selectpicker('refresh');
});

$('#special2').on('click', function () {
  mySelect.find('option:disabled').prop('disabled', false);
  mySelect.selectpicker('refresh');
});

$('#basic2').selectpicker({
  liveSearch: true,
  maxOptions: 1
});
</script>
<script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>

						<script type="text/javascript">
						$("#checkAll").change(function () {
							    $("input:checkbox").prop('checked', $(this).prop("checked"));
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
