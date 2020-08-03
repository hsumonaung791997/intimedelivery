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
				<h3 class="panel-title">Account Head List</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>Account ID</th>
							<th>Name</th>
							<th>Type</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($result as $row)
						<tr>
							<td>
								{{$row->account_id}}
							</td>
							<td>
								{{$row->name}}
							</td>
							<td>
								{{$row->type}}
							</td>
							<td>
								<div class="dropdown">
									<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Modify
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<div class="text-center">
											<a class="dropdown-item" href="{{ route('account.head.edit', $row->account_id) }}">Edit</a>
										</div>
										<div class="text-center">
											<a class="dropdown-item" href="{{ route('account.head.destroy', $row->account_id) }}">Delete</a>
										</div>
									</div>
								</div>  
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
{{ $result->links() }}
@endsection