@extends("layouts.admin")
@section('content')

<div class="row">

			<div class="col-md-6">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Issue Create</h3>
								</div>
								<div class="panel-body">
									@if(isset($edit))
										<form action="{{URL::to('admin/issue/update/')}}" method="post">
											@csrf
										<div class="col-md-12 col-lg-12 col-sm-12">
						                    <div class="col-md-8	 col-lg-8 col-sm-8">
						                    	<input type="hidden" name="id" value="@foreach($edit as $res) {{$res->id}} @endforeach">
							                    <input type="text" class="form-control" name="name" value="@foreach($edit as $res) {{$res->name}} @endforeach" placeholder="Enter Issue">
							                  </div>
							                  <div class="col-md-2 col-sm-2 col-lg-2">
							                    <input type="submit" name="filter" value="Submit" class="btn btn-primary">
						                  </div>
					                  </div>
					                  </form>
					                  @else
					                  <form action="{{URL::to('admin/issue/store')}}" method="POST">
					                  	@csrf
										<div class="col-md-12 col-lg-12 col-sm-12">
						                    <div class="col-md-8	 col-lg-8 col-sm-8">
							                    <input type="text" class="form-control" name="name" value="" placeholder="Enter Issue">
							                  </div>
							                  <div class="col-md-2 col-sm-2 col-lg-2">
							                    <input type="submit" name="filter" value="Submit" class="btn btn-primary">
						                  </div>
					                  </div>
					                  </form>
					                  @endif

									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Issue Type</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; ?>
											@foreach($result as $row)
											<tr>
												<td>{{$i++}}</td>
												<td>{{$row->name}}</td>
												<td>
													<a href="{{URL::to('admin/issue/edit/'.$row->id)}}" class="btn btn-primary btn-sm">
													Edit
													</a>
													<a href="{{URL::to('admin/issue/delete/'.$row->id)}}" class="btn btn-danger btn-sm">Delete
													</a>
													
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
							
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>

</div>
@endsection
