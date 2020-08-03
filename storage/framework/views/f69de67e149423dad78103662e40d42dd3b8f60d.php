<?php $__env->startSection('content'); ?>

<div class="row">

	<div class="col-md-12">

		<!-- BASIC TABLE -->
		<div class="panel">

			<div class="panel-heading">
				<h3 class="panel-title">Account Head Create</h3>
			</div>

			<div class="panel-body">
				<div class="row">
					<form method="post" action="<?php echo e(isset($result) ? route('account.head.ledger.update', $result->id) : route('account.head.ledger.store')); ?>" class="form-signin" autocomplete="off" class="form-horizontal">
						<?php echo csrf_field(); ?>
						<?php if(isset($result)): ?>
						<?php echo method_field('PUT'); ?>
						<?php endif; ?>

						<?php if($errors->any()): ?>
						<div class="alert alert-danger">
							<ul>
								<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($error); ?></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
						<?php endif; ?>

						<div class="form-group">
							<label for="account_head_id"><?php echo e(__('Account Name')); ?></label>
							<select name="account_head_id" id="account_head_id" class="form-control">
								<option value="" data-type="">--Choose Account Name--</option>
								<?php $__currentLoopData = $accountheads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accounthead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option
								value="<?php echo e($accounthead->id); ?>"
								data-type="<?php echo e($accounthead->type); ?>"
								<?php if( old('account_head_id', isset($result) ? $result->account_head_id : '' ) == $accounthead->id  ): ?>
								selected
								<?php endif; ?>
								>
								<?php echo e($accounthead->name); ?>

								</option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<div>
								<span class="text-info">Account Type : </span>
								<span id="accountType"></span>
							</div>
						</div>

						<div class="form-group">
							<label for="amount"><?php echo e(__('Amount')); ?></label>
							<input type="text" name="amount" class="form-control" id="amount" placeholder="Amount" value="<?php echo e(old('amount', isset($result) ? $result->amount : '' )); ?>" required>
						</div>

						<div class="form-group">
							<label for="date"><?php echo e(__('Date')); ?></label>
							<input type="date" name="date" class="form-control" id="date" placeholder="Date" value="<?php echo e(old('date', isset($result) ? $result->date : '' )); ?>" required>
						</div>

						<div class="form-group">
							<label for="postman_name"><?php echo e(__('Employee Name')); ?></label>
							<select name="postman_name" id="postman_name" class="form-control">
								<option value="">--Choose Employee Name--</option>
								<?php $__currentLoopData = $postmen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option
								value="<?php echo e($postman->name); ?>"
								<?php if( old('postman_name', isset($result) ? $result->postman_name : '' ) == $postman->name ): ?>
								selected
								<?php endif; ?>
								>
								<?php echo e($postman->name); ?>

								</option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>

						<button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
					</form>
				</div>
			</div>

		</div>

	</div>
	<!-- END BASIC TABLE -->
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thiri/yoonhanthar/intime-delivery/resources/views/admin/account-head-ledger/create.blade.php ENDPATH**/ ?>