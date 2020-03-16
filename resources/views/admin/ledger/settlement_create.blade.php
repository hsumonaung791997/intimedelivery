@extends("layouts.admin")
@section('content')
<!-- <h3 class="page-title">Parcel Tables</h3> -->
<div class="row">

<div class="col-md-6">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Settlement Create</h3>
								</div>
								<div class="panel-body">
									<form>
							  <div class="form-group">
							    <label for="exampleInputEmail1">Acc -T -ID</label>
							    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Acc - T -ID">
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">T - Amount</label>
							    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">Paid / Unpaid</label>
							  <select class="form-control">
							  		<option>Paid</option>
							  		<option>Unpaid</option>
							  </select>
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">Transaction Date:</label>
							    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Res: Date">
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1">transaction Type</label>
							      <select class="form-control">
							  		<option>Settlement</option>
							  		<option>Ledger</option>
							  </select>
							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1">Reason</label>
							    <textarea class="form-control">
							    	
							    </textarea>
							  </div>
							  <div class="form-check">
							    <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> -->
							    <!-- <label class="form-check-label" for="exampleCheck1">Check me out</label> -->
							  </div>
							  <a href="{{URL::to('admin/ledger/list')}}" class="btn btn-primary">Submit</a>
							</form>
								</div>
							</div>
							<!-- END BASIC TABLE -->
</div>

</div>
@endsection
