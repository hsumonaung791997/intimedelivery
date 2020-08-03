@extends("layouts.admin")
@section('content')

<div class="row">

	<div class="col-md-12">

		<!-- BASIC TABLE -->
		<div class="panel">

			<div class="panel-heading">
				<h3 class="panel-title">Account Head Create</h3>
			</div>

			<div class="panel-body">
				<div class="row">
					<form method="post" action="{{ isset($result) ? route('account.head.update', $result->account_id) :
					route('account.head.store') }}" class="form-signin" autocomplete="off" class="form-horizontal">
						@csrf
						@if (isset($result))
						@method('PUT')
						@endif

						@if ($errors->any())
						<div class="row">
							<div class="alert alert-danger col-md-6">
								<ul>
									@foreach ($errors->all() as $error)
									<li class="">{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						</div>
						@endif

						<div class="row">
							<div class="form-group col-md-6">
								 
								<label for="account_id">{{ __('Account Code')}}</label>
								<input type="text" name="account_id" class="form-control" id="account_id" placeholder="Account Code" value="{{ old('account_id', isset($result) ? $result->account_id : '' ) }}" required>
								 
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-6">
								<label for="name">{{ __('Account Name')}}</label>
								<input type="text" name="name" class="form-control" id="name" placeholder="Account Name" value="{{ old('name', isset($result) ? $result->name : '') }}" required>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="type" class="">{{ __('Account Type : ')}}</label><br>
							<label class="ml-5">
								<input type="radio" name="type" value={{ $credit }}
								@if ( isset($result) &&  $result->type === $credit )
								checked
								@endif >
								{{ $credit }}
							</label>
							<label>
								<input type="radio" name="type" value={{ $debit }}
								@if ( isset($result) && $result->type ===  $debit  )
								checked
								@endif >
								{{ $debit }}
							</label>
						</div>
					</div>

					<button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>

				</div>
			</form>
		</div>
	</div>
</div>
</div>
<!-- END BASIC TABLE -->
</div>
</div>


@endsection
