@extends("layouts.admin")
@section('content')
<style type="text/css">
	.table > tbody > tr > td {
     vertical-align: middle;
}
</style>
<div class="row">

<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Staff List</h3>
								</div>
								<div class="panel-body">
									<form action="{{URL::to('admin/staff/search')}}" method="get"> 
										@csrf
									<div class="col-md-12 col-lg-12 col-sm-12">
						                    <div class="col-md-3 col-lg-3 col-sm-3">
							                    <input type="text" class="form-control" name="search" placeholder="Search ID,Phone No,N.R.C No">
							                  </div>
							             
							                  <div class="col-md-2 col-sm-2 col-lg-2">
							                    <input type="submit" name="submit" value="Filter" class="btn btn-primary">
						                  </div>
					                  </div>
									</form>
					                  
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Username</th>
												<th>Delivery Name</th>
												<th>Phone No.1</th>
												<th>Phone No.2</th>
												<th>N.R.C No.</th>
												<th>Employment Date</th>
												<th>Image</th>
												<th>Action</th>


											</tr>
										</thead>
										<tbody>
											@if(isset($result))
										@foreach($result as $row)
											
											<tr>
												<td>
													{{$row->id}}
												</td>
												<td>
													{{$row->user_name}}
												</td>
												<td>
													{{$row->delivery_name}}
												</td>
												<td>
													{{$row->ph_one}}
												</td>
												<td>
													{{$row->ph_two}}
												</td>
												<td>
													{{$row->delivery_nrc}}
												</td>
												<td>
													{{$row->employment_date}}
												</td>
												<td>
													<img src="{{URL::to('/file/photo/'.$row->photo)}}" style="height: 80px;">
												</td>
												<td>
   													<div class="dropdown">
  														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    														Modify
  														</button>
  														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    														<div class="text-center"><a class="dropdown-item" href="{{URL::to('admin/staff/edit/'.$row->id)}}">Edit</a></div>
    														<div class="text-center"><a class="dropdown-item" href="{{URL::to('admin/staff/delete/'.$row->id)}}">Delete</a></div>
   														</div>
													</div>   
                      												
												</td>

										</tr>
										@endforeach
										@else
										@foreach($data as $row)
											
											<tr>
												<td>
													{{$row->id}}
												</td>
												<td>
													{{$row->user_name}}
												</td>
												<td>
													{{$row->delivery_name}}
												</td>
												<td>
													{{$row->ph_one}}
												</td>
												<td>
													{{$row->ph_two}}
												</td>
												<td>
													{{$row->delivery_nrc}}
												</td>
												<td>
													{{$row->employment_date}}
												</td>
												<td>
													<img src="{{URL::to('/file/photo/'.$row->photo)}}" style="height: 80px;">
												</td>
												<td>
   													<div class="dropdown">
  														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    														Modify
  														</button>
  														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    														<div class="text-center"><a class="dropdown-item" href="{{URL::to('admin/staff/edit/'.$row->id)}}">Edit</a></div>
    														<div class="text-center"><a class="dropdown-item" href="{{URL::to('admin/staff/delete/'.$row->id)}}">Delete</a></div>
   														</div>
													</div>   
                      												
												</td>

										</tr>
										@endforeach
										@endif
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BASIC TABLE -->
						</div>
						
</div>
@if(isset($data))
{{ $data->render("pagination::bootstrap-4") }}
@else
{{ $result->appends(Request::except('/admin/postman/search'))->setPath('/admin/postman/search') }}
@endif
@endsection