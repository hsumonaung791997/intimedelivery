@extends("layouts.tables")
@section('content')
<h3 class="page-title">Parcel Tables</h3>
<div class="row">

<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Parcel List</h3>
								</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Parcel Name</th>
												<th>Product Size</th>
												<th>Product Type</th>
												<th>Product Vendor Name</th>
												<th>Username</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>Shoe</td>
												<td>9 size</td>
												<td>Walking shoe</td>
												<td>Snipp Online Shop</td>
												<td>Kyaw Kyaw</td>
												<td>Assign</td>
												<td>
													<div class="dropdown">
  														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    														Modify
  														</button>
  														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    														<div class="text-center"><a class="dropdown-item" href="#">Edit</a></div>
    														<div class="text-center"><a class="dropdown-item" href="#">Delete</a></div>
   														</div>
													</div>   
                      
												</td>
											</tr>
											
											
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BASIC TABLE -->
</div>

</div>
@endsection
