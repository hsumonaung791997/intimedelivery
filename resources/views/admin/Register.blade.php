@extends("layouts.tables")
@section('content')
<style type="text/css">
	.my-custom-scrollbar {
position: relative;
height: 200px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}
</style>
<div class="row">
	
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title">Register Form</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">

	
<div class="form-area">  
        <form role="form">
                  
        			<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Division/State" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Township" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="village" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Address" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Address" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="email" name="email" placeholder="Quantity" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Amount" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Register Date" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Target Date" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Target Time" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Product name" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Product Id" required>
					</div>
            
        <button type="button" id="submit" name="submit" class="btn btn-primary pull-right">submit</button>
        </form>
    </div>
				</div>

				<div class=col-md-8>
					<div class="table-wrapper-scroll-y my-custom-scrollbar">

						  <table class="table table-bordered table-striped mb-0">
						    <thead>
						      <tr>
						        <th scope="col">No</th>
						        <th scope="col">Division/State</th>
						        <th scope="col">Township</th>
						        <th scope="col">Village</th>
						        <th scope="col">Address</th>
						        <th scope="col">Qty</th>
						        <th scope="col">Amount</th>
						        <th scope="col">Reg Date</th>
						        <th scope="col">Target Date</th>
						        <th scope="col">Target Time</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <th scope="row">1</th>
						        <td>Mark</td>
						        <td>Otto</td>
						        <td>@mdo</td>
						      </tr>
						      <tr>
						        <th scope="row">2</th>
						        <td>Jacob</td>
						        <td>Thornton</td>
						        <td>@fat</td>
						      </tr>
						      <tr>
						        <th scope="row">3</th>
						        <td>Larry</td>
						        <td>the Bird</td>
						        <td>@twitter</td>
						      </tr>
						      <tr>
						        <th scope="row">4</th>
						        <td>Mark</td>
						        <td>Otto</td>
						        <td>@mdo</td>
						      </tr>
						      <tr>
						        <th scope="row">5</th>
						        <td>Jacob</td>
						        <td>Thornton</td>
						        <td>@fat</td>
						      </tr>
						      <tr>
						        <th scope="row">6</th>
						        <td>Larry</td>
						        <td>the Bird</td>
						        <td>@twitter</td>
						      </tr>
						    </tbody>
						  </table>

					</div>


				</div>
			</div>
		</div>
	</div>
</div>

@endsection

