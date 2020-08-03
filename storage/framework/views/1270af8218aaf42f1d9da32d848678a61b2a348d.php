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
					<form method="post" action="<?php echo e(isset($result) ? route('account.head.update', $result->account_id) :
					route('account.head.store')); ?>" class="form-signin" autocomplete="off" class="form-horizontal">
						<?php echo csrf_field(); ?>
						<?php if(isset($result)): ?>
						<?php echo method_field('PUT'); ?>
						<?php endif; ?>

						<?php if($errors->any()): ?>
						<div class="row">
							<div class="alert alert-danger col-md-6">
								<ul>
									<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li class=""><?php echo e($error); ?></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</div>
						</div>
						<?php endif; ?>

						<div class="row">
							<div class="form-group col-md-6">
								 
								<label for="account_id"><?php echo e(__('Account Code')); ?></label>
								<input type="text" name="account_id" class="form-control" id="account_id" placeholder="Account Code" value="<?php echo e(old('account_id', isset($result) ? $result->account_id : '' )); ?>" required>
								 
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-6">
								<label for="name"><?php echo e(__('Account Name')); ?></label>
								<input type="text" name="name" class="form-control" id="name" placeholder="Account Name" value="<?php echo e(old('name', isset($result) ? $result->name : '')); ?>" required>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="type" class=""><?php echo e(__('Account Type : ')); ?></label><br>
							<label class="ml-5">
								<input type="radio" name="type" value=<?php echo e($credit); ?>

								<?php if( isset($result) &&  $result->type === $credit ): ?>
								checked
								<?php endif; ?> >
								<?php echo e($credit); ?>

							</label>
							<label>
								<input type="radio" name="type" value=<?php echo e($debit); ?>

								<?php if( isset($result) && $result->type ===  $debit  ): ?>
								checked
								<?php endif; ?> >
								<?php echo e($debit); ?>

							</label>
						</div>
					</div>

					<button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>

				</div>
			</form>
		</div>
	</div>
</div>
</div>
<!-- END BASIC TABLE -->
</div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/account-head/create.blade.php ENDPATH**/ ?>