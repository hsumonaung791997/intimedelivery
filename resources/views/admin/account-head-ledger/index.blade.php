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
				<h3 class="panel-title">Ledger List</h3>
			</div>
			<form action="{{route('ledger-list-search')}}" method="get">
				@csrf
				@method('GET')
				<?php 
						                    	if(isset($_GET['start_date'])){
														$start_date=$_GET['start_date'];						                    		
						                    	}else{
						                    		$start_date="";
						                    	}
						                    	if(isset($_GET['end_date'])){
														$end_date=$_GET['end_date'];						                    		
						                    	}else{
						                    		$end_date="";
						                    	}
						                    	 ?>
				<div class="col-md-12">
					<label>Start Date: </label>
					<input type="date" name="start_date" id="start_date" value="{{$start_date}}">
					<label>End Date:</label>
					<input type="date" name="end_date" id="end_date" value="{{$end_date}}">
					<input type="submit" name="search" value="Search" class="btn btn-primary">
					<input type="submit" name="print" value="Print" class="btn btn-success">
					
				</div>	


				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>Account Code</th>
								<th>Account Name</th>
								
								<th>Cr</th>
								<th>Dr</th>
								<th>Date</th>
								<th>Remark</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="tbody">
							@foreach( $result as $row )
							<tr>
								<td>
									{{ $row->accounthead->account_id }}
								</td>
								<td>
									{{ $row->accounthead->name }}
								</td>
								
								<td>
									{{ $row->cr_amount }}
								</td>
								<td>
									{{ $row->dr_amount }}
								</td>
								<td>
									{{ $row->date }}
								</td>
								<td>
									{{ $row->remark }}
								</td>
								<td>
									<div class="dropdown">
										<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Modify
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<div class="text-center">
												<a class="dropdown-item" href="{{ route('account.head.ledger.edit', $row->id) }}">Edit</a>
											</div>
											<div class="text-center">
												<a class="dropdown-item" href="{{ route('account.head.ledger.destroy', $row->id) }}">Delete</a>
											</div>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
							<tr>
								<td colspan="2">
									<b>Total</b>
								</td>
								<td>
									{{ $result->sum('cr_amount') }}
								</td>
								<td>
									{{ $result->sum('dr_amount') }}
								</td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</div>
	<!-- END BASIC TABLE -->
</div>

{{ $result->links() }}

<!-- <script type="text/javascript">

		$(function () {
			$("#start_date,#end_date").on('change',function () {

				$start_date=$('#start_date').val();
				$end_date=$('#end_date').val();
				 

				$.ajax({

					type : 'get',

					url : '{{URL::to('/admin/date/ledger-list')}}',

					data:{'start_date':$start_date,'end_date':$end_date},

					success:function(data){

						$('#tbody').html(data);
					}

				});
			});

		});
	</script> -->
	@endsection
