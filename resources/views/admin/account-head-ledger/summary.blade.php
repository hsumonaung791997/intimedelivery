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
				<h3 class="panel-title">Gross Profit</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>Account ID</th>
							<th>Account Name</th>
							<th>Cr</th>
							<th>Dr</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $result as $account )
						<tr>
							<td>
								{{ $account->account_id }}
							</td>
							<td>
								{{ $account->name }}
							</td>
							<td>
								{{ $account->accountheadledgers->sum('cr_amount') }}
							</td>
							<td>
								{{ $account->accountheadledgers->sum('dr_amount') }}
							</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="2">
								<b>Total</b>
							</td>
							<td>
								{{ $result->sum('cr_total') }}
							</td>
							<td>
								{{ $result->sum('dr_total') }}
							</td>
						</tr>
					</tbody>
				</table>
				{{ $result->links() }}
			</div>

		</div>
		<!-- END BASIC TABLE -->



	</div>

</div>
@endsection
