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
					<form method="post" action="{{ isset($result) ? route('account.head.ledger.update', $result->id) : route('account.head.ledger.store') }}" class="form-signin" autocomplete="off" class="form-horizontal">
						@csrf
						@if (isset($result))
						@method('PUT')
						@endif

						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif
						<div class="row">
							<div class="form-group col-md-6">
								<label for="account_head_id">{{ __('Account Name')}}</label>
								<select name="account_head_id" id="account_head_id" class="form-control">
									<option value="" data-type="" data-account_id="">--Choose Account Name--</option>
									 
									@foreach ($accountheads as $accounthead)
									<option
									value="{{ $accounthead->id }}"
									data-type="{{ $accounthead->type }}" data-account_id="{{ $accounthead->account_id}}"
									@if( old('account_head_id', isset($result) ? $result->account_head_id : '' ) == $accounthead->id  )
									selected
									@endif
									>
									{{ $accounthead->name }}
									</option>
									@endforeach
								</select>
								<br>
							<div class="form-group">
								<span class="text-danger font-weight-bold">Account Type : </span>
								<span id="accountType" class="text-danger font-weight-bold"></span>
							</div>
						</div>

						 <div class="form-group col-md-6">
							<label for="amount">{{ __('Amount')}}</label>
							<input type="text" name="amount" class="form-control" id="amount" placeholder="Amount" value="{{ old('amount', isset($result) ? $result->amount : '' ) }}" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="date">{{ __('Date')}}</label>
							<input type="date" name="date" class="form-control" id="date" placeholder="Date" value="{{ old('date', isset($result) ? $result->date : '' ) }}" required>
						</div>
						<div class="form-group col-md-6">
							<label for="postman_name">{{ __('Employee Name')}}</label>
							<select name="postman_name" id="postman_name" class="form-control">
								<option value="">--Choose Employee Name--</option>
								@foreach ($postmen as $postman)
								<option
								value="{{ $postman->user_name }}"
								@if( old('postman_name', isset($result) ? $result->postman_name : '' ) == $postman->user_name )
								selected
								@endif
								>
								{{ $postman->user_name }}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="form_lastname">Remark</label>
                			<input class="form-control" name="remark"  required="required" value="-">
						</div><br>
						<button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
					</div>
					</form>
				</div>
			</div>

		</div>

	</div>
	<!-- END BASIC TABLE -->
</div><!-- 
<script type="text/javascript">
	$(function(){

		 $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    	});

		$('#account_head_id').on('click',function(){
			alert('OK');
			$account_head_id =$('#account_head_id').val();
			$.ajax({

					type : 'get',

					url : '{{URL::to('/admin/account-head/account_code')}}',

					data:{'account_head_id':$account_head_id},
					success:function(data){

						$('#account_id').html(data);
					}

				});
		})
	})
</script> -->
@endsection
